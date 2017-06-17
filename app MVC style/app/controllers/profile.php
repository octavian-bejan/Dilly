<?php
	class Profile extends Controller
	{
		public  function index($data = "")
		{
			$profile_id = $data;
			if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "")
			{
				//utilizatorul e autentificat
				if($_SESSION["user_id"] == $profile_id)
				{
					//utilizatorul cere acces la pagina proprie
					$all_posts = $this->get_all_posts($profile_id, null, null);
					$this->view("profile/index", array("moments" => $all_posts));
					exit();
				}else{
					//utilizatorul cere acces la alta pagina
					//trebuie sa verificam daca ii permite sa acceseze pagina
					if(1 == 0)
					{
						$this->view("profile/index", array());
						exit();
					}else
					{
						//to do
					}
				}
			}else
			{
				global $homeUrl;
				$url = $homeUrl . "/login/index";
				header('Location: ' . $url, true, 303);
				exit();
			}
		}

		private function get_all_posts($user_id="",$from="",$to="") {
				$connection = $this->model("DataBase")->getConnection();
  				$stid = oci_parse($connection,"SELECT * FROM app_content WHERE user_id = :user_id ORDER BY took_place DESC");
  				oci_bind_by_name($stid, "user_id", $user_id);
				oci_execute($stid);
				$nr_rows = oci_fetch_all($stid, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($stid);
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