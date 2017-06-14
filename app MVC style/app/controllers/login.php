<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require_once '../app/libraries/google-api-php-client-2.1.1/vendor/autoload.php';

	class Login extends Controller
	{
		public function index($data = "")
		{
			if(isset($_SESSION['id']) && $_SESSION['id']!='')
            {
            	global $homeUrl;
                $url = $homeUrl;

				header('Location: ' . $url, true, 303);
				exit();
            }else
            {
            	global $homeUrl;
                $url = $homeUrl;
				$this->view("login/index", array($url));
            }
		}

		public function login_callback_google($data = "")
		{
			if(isset($_POST['ID_TOKEN']) && $_POST['ID_TOKEN']!='')
			{
				$client = new Google_Client();
				$guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
				$client->setHttpClient($guzzleClient);
				$payload = $client->verifyIdToken($_POST['ID_TOKEN']);
				if ($payload) {
					$family_name = $payload["family_name"];
					$given_name = $payload["given_name"];
					$email = $payload["email"];
					$picture = $payload["picture"];
					$id = $payload["sub"];

					//verificam daca e utilizator nou
					$connection = $this->model("DataBase")->getConnection();
					$stid = oci_parse($connection,"SELECT id AS \"id\"FROM app_users WHERE google_id = :g_id AND type = 1");
					oci_bind_by_name($stid, ":g_id", $id);
					oci_execute($stid);
					$nr_rows = oci_fetch_all($stid, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
					oci_free_statement($stid);
					
					$user_id = "";
					if($nr_rows == 1)
					{
						//exista asa utilizator
						$user_id = $result[0]["id"];
					}else
					{
						//nu exista acest utilizator
						$stid = oci_parse($connection,"SELECT MAX(id) AS \"maxim\" FROM app_users");
						oci_execute($stid);
						$user_id = oci_fetch_assoc($stid)["maxim"] + 1;
						oci_free_statement($stid);

						$stid = oci_parse($connection,"INSERT INTO app_users VALUES(:id, null, null, :g_id, 1)");
						oci_bind_by_name($stid, ":g_id", $id);
						oci_bind_by_name($stid, ":id", $user_id);
						oci_execute($stid);
						oci_free_statement($stid);

						$stid = oci_parse($connection,"INSERT INTO user_credentials VALUES(:id, :email, :f_name, :l_name, null, null, null)");
						oci_bind_by_name($stid, ":id", $user_id);
						oci_bind_by_name($stid, ":email", $email);
						oci_bind_by_name($stid, ":f_name", $given_name);
						oci_bind_by_name($stid, ":l_name", $family_name);
						oci_execute($stid);
						oci_free_statement($stid);
					}

					oci_close($connection);

					$_SESSION["user_id"] = $user_id;
					$_SESSION["family_name"] = $family_name;
					$_SESSION["given_name"] = $given_name;

					global $homeUrl;
					$url = $homeUrl . "/profile/" . $user_id;
					header('Location: ' . $url, true, 303);
					exit();

				} else {
					global $homeUrl;
                	$url = $homeUrl;
					$this->view("login/index", array($url));
				}
			}else
			{
				global $homeUrl;
                $url = $homeUrl;
				$$this->view("login/index", array($url));
			}
		}

		public function login_callback_classic($data = "")
		{
			if(isset($_POST["loginuser"]) && isset($_POST["loginpass"]) && $_POST["loginuser"] != "" && $_POST["loginpass"] != "")
			{
				$username = $_POST["loginuser"];
				$pass = $_POST["loginpass"];

				$connection = $this->model("DataBase")->getConnection();
				$stid = oci_parse($connection,"SELECT id AS \"id\"FROM app_users WHERE username = :username AND password = :pass AND type = 0");
				oci_bind_by_name($stid, ":username", $username);
				oci_bind_by_name($stid, ":pass", $pass);
				oci_execute($stid);
				$nr_rows = oci_fetch_all($stid, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($stid);
				oci_close($connection);

				if($nr_rows == 1)
				{
					//exista asa utilizator
					$user_id = $result[0]["id"];

					$_SESSION["user_id"] = $user_id;
					$_SESSION["family_name"] = $family_name;
					$_SESSION["given_name"] = $given_name;

					global $homeUrl;
					$url = $homeUrl . "/profile/" . $user_id;
					header('Location: ' . $url, true, 303);
					exit();
				}else
				{
					global $homeUrl;
	                $url = $homeUrl;
					$this->view("login/index", array($url, "message" => "Wrong USERNAME or PASSWORD!"));
				}
			}else
			{
				global $homeUrl;
                $url = $homeUrl;
				$this->view("login/index", array($url));
			}
		}

		public function forgot_password()
		{
			//aaaa
		}

		public function sign_up()
		{
			if(isset($_POST["newfirstname"]) && $_POST["newfirstname"] != "" && isset($_POST["newlastname"]) && $_POST["newlastname"] != "" && isset($_POST["newusername"]) && $_POST["newusername"] != "" && isset($_POST["newpassword"]) && $_POST["newpassword"] != "" && isset($_POST["newemail"]) && $_POST["newemail"] != "")
			{
				$username = $_POST["newusername"];
				$pass = $_POST["newpassword"];
				$firstname = $_POST["newfirstname"];
				$lastname = $_POST["newlastname"];
				$email = $_POST["newemail"];

				$birth = null;
				if(isset($POST_["newbdate"]))
				{
					$birthday = $_POST['newbdate'] . '';
					echo $birthday; exit();
					$date=date_create($birthday);
					$birth = date_format($date,"d-M-y");
				}

				$connection = $this->model("DataBase")->getConnection();

				$stid = oci_parse($connection,"SELECT id AS \"id\"FROM app_users WHERE username = :username AND type = 0");
				oci_bind_by_name($stid, ":username", $username);
				oci_execute($stid);
				$nr_rows = oci_fetch_all($stid, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($stid);

				if($nr_rows == 1)
				{
					//exista deja username
					global $homeUrl;
	                $url = $homeUrl;
					$this->view("login/index", array($url, "message" => "USERNAME already exists!"));
					exit();
				}else
				{
					//nu exista acest utilizator
						$stid = oci_parse($connection,"SELECT MAX(id) AS \"maxim\" FROM app_users");
						oci_execute($stid);
						$user_id = oci_fetch_assoc($stid)["maxim"] + 1;
						oci_free_statement($stid);

						$stid = oci_parse($connection,"INSERT INTO app_users VALUES(:id, :username, :pass, null, 0)");
						oci_bind_by_name($stid, ":id", $user_id);
						oci_bind_by_name($stid, ":username", $username);
						oci_bind_by_name($stid, ":pass", $pass);
						oci_execute($stid);
						oci_free_statement($stid);

						$stid = oci_parse($connection,"INSERT INTO user_credentials VALUES(:id, :email, :f_name, :l_name, :birth, null, null)");
						oci_bind_by_name($stid, ":id", $user_id);
						oci_bind_by_name($stid, ":email", $email);
						oci_bind_by_name($stid, ":f_name", $firstname);
						oci_bind_by_name($stid, ":l_name", $lastname);
						oci_bind_by_name($stid, ":birth", $birth);
						oci_execute($stid);
						oci_free_statement($stid);
				}

				oci_close($connection);

				$_SESSION["user_id"] = $user_id;
				$_SESSION["family_name"] = $family_name;
				$_SESSION["given_name"] = $given_name;

				global $homeUrl;
				$url = $homeUrl . "/profile/" . $user_id;
				header('Location: ' . $url, true, 303);
				exit();
			}else
			{
				global $homeUrl;
                $url = $homeUrl;
				$this->view("login/index", array($url));
			}
		}
	}
?>