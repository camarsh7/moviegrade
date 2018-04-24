<?php
	include 'dbconfig.php';

	class DatabaseConnection {
		protected $conn = null;
		
		public function __construct() {
			
		}
		
		public function OpenConnection() {
			$this->conn = new mysqli(servername, username, password, dbname) or die($conn->connect_error);
			return $this->conn;
		}
		
		public function CloseConnection() {
			$this->conn->close();
		}
	}
?>