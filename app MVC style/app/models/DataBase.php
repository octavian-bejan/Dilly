<?php

	class DataBase{
		private $connection;

		private $login = "student";
		private $password = "STUDENT";
		private $address = "localhost/xe";

		public function __construct(){
			$this->connection = oci_connect($this->login, $this->password, $this->address);
		}

		public function getConnection()
		{
			return $this->connection;
		}
	}

?>