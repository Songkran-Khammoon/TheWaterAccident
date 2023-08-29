<?php
	/**
	* Database Connection
	*/
	class DbConnect {
		private $server = 'student.crru.ac.th';
		private $dbname = '631463009';
		private $user = '631463009';
		private $pass = '80707';

		public function connect() {
			try {
				$conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch (\Exception $e) {
				echo "Database Error: " . $e->getMessage();
			}
		}
        
	}
?>