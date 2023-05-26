<?php
	define("db_host", "localhost");
	define("db_user", "root");
	define("db_pass", "");
	define("db_name", "candycorner");
	
	class db_connect{
		public $host = db_host;
		public $user = db_user;
		public $pass = db_pass;
		public $name = db_name;
		public $conn;
		public $error;
		public $mysqli;

		
		public function connect(){
			$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
			
			if(!$this->conn){
				$this->error="Fatal Error: Can't connect to database" . $this->conn->connect_error;
				return false;
			}
		}
		
	}
	function statusReport($status){
		if($status == 0){
			return "Pending";
		}else if($status==1){
			return "Rejected";
		}else if($status==2){
			return "Accepted";
		}else if($status==3){
			return "On the way";
		}
	}
?>