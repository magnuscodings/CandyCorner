<?php
	define("db_host", "localhost");
	define("db_user", "root");
	define("db_pass", "");
	define("db_name", "candycorner");
	// define("db_host", "localhost");
	// define("db_user", "id20878000_username");
	// define("db_pass", "Password123!");
	// define("db_name", "id20878000_name");
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
			return "Preparing";
		}else if($status==3){
			return "Waiting for delivery";
		}else if($status==4){
			return "On the way";
		}else if($status==5){
			return "Delivered";
		}
	}
?>