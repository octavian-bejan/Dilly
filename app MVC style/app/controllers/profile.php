<?php
	class Profile extends Controller
	{
		function index($data = "")
		{
			$profile_id = $data;
			if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "")
			{
				//utilizatorul e autentificat
				if($_SESSION["user_id"] == $profile_id)
				{
					//utilizatorul cere acces la pagina proprie
					$this->view("profile/index", array());
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
	}
?>