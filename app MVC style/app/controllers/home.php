<?php
	class home extends Controller
	{
		public function index($data = "")
		{
			if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "")
			{
				//utilizatorul este deja autentificat
				global $homeUrl;
				$user_id = $_SESSION["user_id"];
				$url = $homeUrl . "/profile/" . $user_id;
				header('Location: ' . $url, true, 303);
				exit();
			}else
			{
				//utilizatorul inca nu e autentificat
				$this->view("home/index", array("parametru" => $data));
				exit();
			}
		}
	}
?>