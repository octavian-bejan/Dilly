<?php
	class Logout extends Controller
	{
		public function index($data = "")
		{

			global $homeUrl;
			session_unset();
			session_destroy();
			$this->view("logout/index", array());
			exit();
		}
	}
?>