<?php

	class User{

		public function getUsersTools($isSelected=0)
		{
			global $root;
			$userTools = "";
			if($this->isLogged())
            {
            	if($isSelected == 1)
            	{
            		$userTools = "<div id=\"left_user_tools\"><div class=\"left_menu_item\" id=\"left_menu_title\">Instrumente</div><button class=\"left_menu_item\" id=\"left_menu_add_article_selected\" onclick=\"location.href='" . $root . "new_article/index';\">Scrie un articol</button><button class=\"left_menu_item\" id=\"left_menu_add_thread\" onclick=\"location.href='" . $root . "new_thread/index';\">Creează un thread</button><button class=\"left_menu_item\" id=\"left_menu_add_recipe\" onclick=\"location.href='" . $root . "new_recipe/index';\">Scrie o rețetă</button></div>";
            	}else
            	if($isSelected == 2)
            	{
            		$userTools = "<div id=\"left_user_tools\"><div class=\"left_menu_item\" id=\"left_menu_title\">Instrumente</div><button class=\"left_menu_item\" id=\"left_menu_add_article\" onclick=\"location.href='" . $root . "new_article/index';\">Scrie un articol</button><button class=\"left_menu_item\" id=\"left_menu_add_thread_selected\" onclick=\"location.href='" . $root . "new_thread/index';\">Creează un thread</button><button class=\"left_menu_item\" id=\"left_menu_add_recipe\" onclick=\"location.href='" . $root . "new_recipe/index';\">Scrie o rețetă</button></div>";
            	}else
            	if($isSelected == 3)
            	{
	            	//e conectat
	            	$userTools = "<div id=\"left_user_tools\"><div class=\"left_menu_item\" id=\"left_menu_title\">Instrumente</div><button class=\"left_menu_item\" id=\"left_menu_add_article\" onclick=\"location.href='" . $root . "new_article/index';\">Scrie un articol</button><button class=\"left_menu_item\" id=\"left_menu_add_thread\" onclick=\"location.href='" . $root . "new_thread/index';\">Creează un thread</button><button class=\"left_menu_item\" id=\"left_menu_add_recipe_selected\" onclick=\"location.href='" . $root . "new_recipe/index';\">Scrie o rețetă</button></div>";
	            }else
            	{
	            	//e conectat
	            	$userTools = "<div id=\"left_user_tools\"><div class=\"left_menu_item\" id=\"left_menu_title\">Instrumente</div><button class=\"left_menu_item\" id=\"left_menu_add_article\" onclick=\"location.href='" . $root . "new_article/index';\">Scrie un articol</button><button class=\"left_menu_item\" id=\"left_menu_add_thread\" onclick=\"location.href='" . $root . "new_thread/index';\">Creează un thread</button><button class=\"left_menu_item\" id=\"left_menu_add_recipe\" onclick=\"location.href='" . $root . "new_recipe/index';\">Scrie o rețetă</button></div>";
	            }
            }
			return $userTools;
		}

		public function getUserInfo()
		{
			global $root;
			$userInfo = "";
			if($this->isLogged())
            {
            	//e conectat
            	$userInfo = "<div id=\"user-info\"><div class=\"user_info_main\" onclick=\"cancelHidding();\"><div id=\"user_info_top\">" . "<div id=\"user_info_top_img\"><img src=\"" . $_SESSION["picture"] . "\" class=\"circle_img\" height=\"60px\" width=\"60px\"/></div><div id=\"user_info_top_info\">" . $_SESSION["family_name"] . " " . $_SESSION["given_name"] . "</br><button id=\"button\" onclick=\"location.href='" . $root . "profile/index/" . $_SESSION["id"] . "';\">Profil</button></div></div><div id=\"user_info_bottom\"><button id=\"button\" onclick=\"location.href='" . $root . "logout/index" . "';\">Deconectează-te</button></div></div></div>";
            }
			return $userInfo;
		}

		public function getLoginButton()
		{
			global $root;
			$loginButton = "";
			if($this->isLogged())
            {
            	//aparent e conectat
            	//$loginButton = "<button id=\"profileBtn\" onclick=\"toggleMenu();\"></button>";
            	$loginButton = "<img id=\"profileIMG\" src=\"" . $_SESSION["picture"] . "\" height=\"30px\" width=\"30px\" onclick=\"toggleMenu();\">";
            }else
            {
            	//nu e conectat
            	$loginButton = "<button id=\"button\" onclick=\"location.href='" . $root . "login/index" . "';\">Conectează-te</button>";
            }
            return $loginButton;
		}

		public function isLogged()
		{
			if(isset($_SESSION['id']) && $_SESSION['id']!='')
			{
				return true;
			}else
			{
				return false;
			}
		}

		public function getId()
		{
			if($this->isLogged())
			{
				return $_SESSION["id"];
			}else
			{
				return "";
			}
		}

		public function getUserCommentForm()
		{
			global $root;
			$userCommentForm = "";
			if($this->isLogged())
            {
            	//aparent e conectat
            	$userCommentForm = "<div id=\"comment_form_img\"><img src=\"" . $_SESSION["picture"] . "\" height=\"50px\" width=\"50px\"></div><div id=\"comment_form_main\"><div contentEditable=\"true\" id=\"comment_content\" onfocus=\"showCommentButtons();\"></div><div id=\"comment_buttons\"><button onclick=\"hideCommentButtons();\" id=\"button\">Anulează</button><button onclick=\"sendComment();\" id=\"button\">Trimite</button></div></div>";
            }
            return $userCommentForm;
		}
	}

?>