<?php
	class home extends Controller
	{
		public function index($data = "")
		{
			$this->view("home/index", array("parametru" => $data));
		}
	}
?>