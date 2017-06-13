<?php
	class Profile extends Controller
	{
		function index($data = "")
		{
			$id = $data;
			//verificam existenta in baza de date a utilizatorului
			$mysqli = $this->model("DataBase")->getConnection();

			if (!($prepared_stmt = $mysqli->prepare("SELECT given_name, family_name, picture, email FROM users WHERE id = ?")))
			{
				//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
				//eroare:  $mysqli->errno; $mysqli->error;
				$this->view("error/index", array("Eroare: problema de la BD"));
				exit();
			}

			if (!$prepared_stmt->bind_param("s", $id))
			{
			    //echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			    $this->view("error/index", array("Eroare: problema de la BD"));
			    exit();
			}

			if (!$prepared_stmt->execute())
			{
			    //echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			    $this->view("error/index", array("Eroare: problema de la BD"));
			    exit();
			}

			$result = $prepared_stmt->get_result();
			if($result->num_rows == 0)
			{
				//eroare, nu exista utilizatorul
				$this->view("error/index", array("Eroare: nu există acest utilizator"));
				exit();
			}
			//utilzator existent
			//din result scoatem datele necesare
			$linie_ca_array = $result->fetch_array();
			$family_name = $linie_ca_array["family_name"];
			$given_name = $linie_ca_array["given_name"];
			$picture = $linie_ca_array["picture"];
			$email = $linie_ca_array["email"];

			$prepared_stmt->close();
			$result->free();
			$mysqli->close();

			$user = $this->model("User");
			$user_tools = $user->getUsersTools(0);
			$recipes_menu = $this->model("Tools")->getRecipesMenu();
			if($user->isLogged())
			{
				//posibil e chiar pagina proprie si trebuie posibilitatea de a edita datele
				if(strcmp($user->getId(), $id) == 0)
				{
					$this->view("profile/index", array("id" => $id, 2 => rand(0, 229), "given_name" => $given_name, "family_name" => $family_name, "picture" => $picture, "email" => $email, "user_tools" => $user_tools, "recipes_menu" => $recipes_menu));
				}else
				{
					$this->view("profile/index", array("id" => $id, 2 => rand(0, 229), "given_name" => $given_name, "family_name" => $family_name, "picture" => $picture, "user_tools" => $user_tools, "recipes_menu" => $recipes_menu));
				}
				exit();
			}else
			{
				$this->view("profile/index", array($id, 2 => rand(0, 229), "given_name" => $given_name, "family_name" => $family_name, "picture" => $picture, "user_tools" => $user_tools, "recipes_menu" => $recipes_menu));
				exit();
			}
		}
	}
?>