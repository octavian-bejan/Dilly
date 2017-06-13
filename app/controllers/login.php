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
				} else {
					global $homeUrl;
                	$url = $homeUrl;
					$this->view("login/index", array($url, 2 => rand(0, 229)));
				}
			}else
			{
				global $homeUrl;
                $url = $homeUrl;
				$this->view("login/index", array($url, 2 => rand(0, 229)));
			}
		}

		public function forgot_password()
		{
			//aaaa
		}
	}
?>