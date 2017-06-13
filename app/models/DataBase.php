<?php

	class DataBase{
		private $connection;

		private $login = "root";
		private $password = "";
		//private $address = "localhost:3306";
		private $address = "127.0.0.1:3306";
		private $db = "gastronomia_romaneasca";

		public function __construct(){
			$this->connection = mysqli_connect($this->address, $this->login, $this->password, $this->db);
			if (mysqli_connect_errno($this->connection)) {
			    //eroare
			    throw new Exception("Nu se poate conecta la baza de date.");
			}
			if (!$this->connection->set_charset("utf8")) {
			    throw new Exception("Eroare: codificare bazei de date nereușită");
			}
		}

		public function getConnection()
		{
			return $this->connection;
		}
	}

?>