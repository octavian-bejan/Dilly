<?php
	class search extends Controller
	{
		public function index($data = "")
		{
			if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "")
			{
				//utilizatorul este deja autentificat
				$tags = $this->parseTags($_POST["searched_tags"]);
				$user_id = $_SESSION["user_id"];

				$posts = array();

				$connection = $this->model("DataBase")->getConnection();
				foreach($tags as $tag)
				{
					$stid = oci_parse($connection,"SELECT content_id from tags WHERE user_id = :user_id AND tag = :tag");
					oci_bind_by_name($stid, ":user_id", $user_id);
					oci_bind_by_name($stid, ":tag", $tag);
					oci_execute($stid);

					oci_fetch_all($stid, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
					foreach($result as $row)
					{
						$posts[$row["CONTENT_ID"]] = 1;
					}

					oci_free_statement($stid);
				}
				oci_close($connection);
				$all_posts = $this->get_posts($user_id, array_keys($posts));
				
				$this->view("profile/index", array("moments" => $all_posts, "message" => "Search results for: <p class=\"text-danger\">" . $_POST["searched_tags"] . "</p>"));
				exit();
			}else
			{
				//utilizatorul inca nu e autentificat
				$this->view("home/index", array("parametru" => $data));
				exit();
			}
		}

		private function parseTags($tags)
        {
        	return explode(' ', $tags);
        }

        private function get_posts($user_id, $posts)
        {
        	$connection = $this->model("DataBase")->getConnection();
        	$result = array();

        	foreach($posts as $content_id)
        	{
        		$stid = oci_parse($connection,"SELECT * FROM app_content WHERE user_id = :user_id AND content_id = :content_id ORDER BY took_place DESC");
				oci_bind_by_name($stid, "user_id", $user_id);
				oci_bind_by_name($stid, "content_id", $content_id);
				oci_execute($stid);

				array_push($result, oci_fetch_assoc($stid));

				oci_free_statement($stid);
        	}

			$i = 0;
			foreach($result as $row)
			{
				$user_id = $row["USER_ID"];
				$content_id = $row["CONTENT_ID"];

				$query = oci_parse($connection,"SELECT tag FROM tags WHERE content_id = :content_id AND user_id = :user_id");
				oci_bind_by_name($query, ":content_id", $content_id);
				oci_bind_by_name($query, "user_id", $user_id);
                oci_execute($query);
				oci_fetch_all($query, $tags, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_NUM);
				oci_free_statement($query);
				$tags = array_map('current', $tags);
				$result[$i]["tag"] = $tags;
				$i++;
			}
			oci_close($connection);
			return $result;
        }
	}
?>