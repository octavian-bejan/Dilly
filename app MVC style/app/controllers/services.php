<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require '../app/vendor/autoload.php';
	use Aws\S3\S3Client;

	class Services extends Controller
	{
		private $MAX = 10485760;
		public function index($data = "")
		{
			$id = $data;
			$this->view("home/index", array());
		}

		public function newMoment()
		{
			//max 10 MB
			global $homeUrl;
            $connection = $this->model("DataBase")->getConnection();
            if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')
            {
	            // user logat
	            $user_id = $_SESSION['user_id'];
				$title = $_POST["title"];
				$date = $_POST["date"];
				$tags = $this->parseTags($_POST["tags"]);
				$today = date ("d-M-Y");
            
	            if (isset($date) && $date!='')
	            {
	                $date = date_format(date_create($date),"d-M-y"); 
	            }
            	else
            	{
            		$date = $today;
                }

                $stid = oci_parse($connection,"SELECT nvl(max(content_id),0) AS \"content\" from app_content  where user_id = :u_id");
				oci_bind_by_name($stid, ":u_id", $user_id);
				oci_execute($stid);
			    $content_id = oci_fetch_assoc($stid)["content"]+1; 
				oci_free_statement($stid);

				$stid = oci_parse($connection,"INSERT INTO app_content VALUES(:content_id, :user_id, :description, :created_at, :took_place,null)");
				oci_bind_by_name($stid, ":content_id", $content_id);
				oci_bind_by_name($stid, ":user_id", $user_id);
				oci_bind_by_name($stid, ":description", $title);
				oci_bind_by_name($stid, ":created_at", $today);
				oci_bind_by_name($stid, ":took_place",$date);
				oci_execute($stid);
				oci_free_statement($stid);

                if (isset($tags))
                {
					foreach ($tags as $tag)
					{
							$stid = oci_parse($connection,"INSERT into tags VALUES(:user_id, :content_id, :tag)");
							oci_bind_by_name($stid, ":user_id", $user_id);
							oci_bind_by_name($stid, ":content_id", $content_id);
							oci_bind_by_name($stid, ":tag", $tag);
							oci_execute($stid);
							oci_free_statement($stid);
					}
				}

				if($_POST["tipImagine"] == "0")
				{
	          		if($_FILES["image"]["error"] == 0)
	          		{
						//a fost incarcat fisierul
						//se incarca pe S3 si se obtine link

						if(!getimagesize($_FILES["image"]["tmp_name"]))
						{
							//eroare de la incarcarea imaginii
							$this->view("error/index", array("message" => "Error in uploading the image!"));
							exit();
						}

						$valid_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP);
						$extensions = array("jpeg", "png", "bmp");
						$size = getimagesize($_FILES['image']['tmp_name']);
						$extension = "";
						if(!in_array($size[2], $valid_types))
						{
						    //tipul nu corespunde
						    $this->view("error/index", array("message" => "Type error. Not a valid image!"));
						    exit();

						}else
						{
							$extension = $extensions[array_search($size[2], $valid_types)];
						}

						if($_FILES["image"]["size"] > $this->MAX)
						{
							//fisierul e prea mare
							 $this->view("error/index", array("message" => "File size too large."));
							 exit();
						}

						$acceptabil = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$nume = "";
					    $lungime = rand(20, 30);
					    for ($i = 0; $i < $lungime; $i++)
					    {
					        $nume .= $acceptabil[rand(0, strlen($acceptabil) - 1)];
					    }

						if(!move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $nume . "." . $extension))
						{
							//eroare
							$this->view("error/index", array("message" => "Sorry ,something went wrong...Please try again."));
							 exit();
						}

						//fisierul incarcat cu succes
						$s3Client = new S3Client([
						    'version'     => 'latest',
						    'region'      => 'eu-central-1',
						    'credentials' => [
						        'key'    => 'KEY',
						        'secret' => 'KEY',
						    ],
						    'http'    => [
						        'verify' => false
						    ]
						]);

						try {
						    $result = $s3Client->putObject([
						        'Bucket' => 'digital.box',
						        'Key'    => $nume . "." . $extension,
						        'Body'   => fopen("upload/" . $nume . "." . $extension, 'r'),
						        'ACL'    => 'public-read',
						    ]);

							//update in baza de date
						    $URL = $result["ObjectURL"]; 

							$stid = oci_parse($connection,"UPDATE app_content set URL = :URL where user_id = :user_id and content_id = :content_id");
							oci_bind_by_name($stid, ":URL", $URL);
							oci_bind_by_name($stid, ":user_id", $user_id);
							oci_bind_by_name($stid, ":content_id", $content_id);
							oci_execute($stid);
							oci_free_statement($stid);

						} catch (Aws\S3\Exception\S3ClientException $e) {
						    echo "There was an error uploading the file.\n";
						}
					}
				}else
				{
					//instagram
					$URL = $_POST["urlOfImageFromInstagram"]; 

					$stid = oci_parse($connection,"UPDATE app_content set URL = :URL where user_id = :user_id and content_id = :content_id");
					oci_bind_by_name($stid, ":URL", $URL);
					oci_bind_by_name($stid, ":user_id", $user_id);
					oci_bind_by_name($stid, ":content_id", $content_id);
					oci_execute($stid);
					oci_free_statement($stid);
				}
                //pagina utilizatorului

				global $homeUrl;
				$url = $homeUrl . "/profile/" . $user_id;
				header('Location: ' . $url, true, 303);
				exit();
			} else
			{
				//pe pagina de login
				global $homeUrl;
				$url = $homeUrl . "/login/index";
				header('Location: ' . $url, true, 303);
				exit();
			}
		}


		private function parseTags($tags)
        {
        	return explode(',', filter_var(rtrim($tags, ','), FILTER_SANITIZE_URL));
        }

        public function newToken()
		{
			if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "")
			{
				if(isset($_GET["code"]) && $_GET["code"] != "")
				{
					//exista cod de la instagram
					$code = $_GET["code"];
					$data = array(
						'client_id'     => "ID",
						'client_secret' => "ID",
						'grant_type'    => 'something',
						'redirect_uri'  => 'path',
						'code'          => $code
					);

					$connection = curl_init();
					curl_setopt($connection, CURLOPT_URL, 'etc');
					curl_setopt($connection, CURLOPT_POST, true);
					curl_setopt($connection, CURLOPT_POSTFIELDS, $data);
					curl_setopt($connection, CURLOPT_HTTPHEADER, array('Accept: application/json'));
					curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($connection, CURLOPT_TIMEOUT, 300);
					curl_setopt($connection, CURLOPT_HEADER, 0);
					curl_setopt($connection, CURLOPT_NOBODY, 0);
					curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);

					
					$result = json_decode(curl_exec($connection));
					curl_close($connection);
					
					$access_token = $result->access_token;
					
					//scriem in baza de date
					$this->writeAT($_SESSION["user_id"], $access_token);
					$this->view("services/newToken");
					exit();
				}else
				{
					//nu exista cod, nu facem nimic
				}
			}
		}

		private function writeAT($user_id, $access_token)
		{
			$connection = $this->model("DataBase")->getConnection();
			$stid = oci_parse($connection,"UPDATE instagram_tokens SET token = :token WHERE user_id = :user_id");
			oci_bind_by_name($stid, ":user_id", $user_id);
			oci_bind_by_name($stid, ":token", $access_token);
			oci_execute($stid);
			oci_free_statement($stid);
			oci_close($connection);
		}

		public function getInstagramPosts()
		{
			if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "")
			{
				$user_id = $_SESSION["user_id"];
				$access_token = $this->getAT($user_id);
				
				//se ia pozele utilzatorului de pe instagram
				$connection = curl_init();
				curl_setopt($connection, CURLOPT_URL, 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $access_token);
				curl_setopt($connection, CURLOPT_HTTPHEADER, array('Accept: application/json'));
				curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($connection, CURLOPT_TIMEOUT, 300);
				curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);

				$result = curl_exec($connection);
				curl_close($connection);
				
				print_r($result);
			}else
			{
				//nu e logat, nu poate primi
				$this->view("error/index", array("messages" => "You are not loged in!"));
			}
		}

		private function getAT($user_id)
		{
			$connection = $this->model("DataBase")->getConnection();
			$stid = oci_parse($connection,"SELECT token AS \"token\" from instagram_tokens WHERE user_id = :user_id");
			oci_bind_by_name($stid, ":user_id", $user_id);
			oci_execute($stid);

			$access_token = oci_fetch_assoc($stid)["token"];

			oci_free_statement($stid);
			oci_close($connection);
			
			return $access_token;
		}
	}
?>