<?php
	class Profile extends Controller
	{
		function index($data = "")
		{
			$id = $data;
			$this->view("profile/index", array());
		}
	}
?>