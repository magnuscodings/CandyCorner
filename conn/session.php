
<?php
	session_start();
	function admin(){
		if(!isset($_SESSION['user_id']) || $_SESSION['user_type']!=2){
			echo"<script>window.location='../index.php'</script>";
		}
	}
	function student(){
		if(!($_SESSION['user_id'])|| $_SESSION['user_type']!=0 ){
			echo"<script>window.location='../index.php'</script>";
	    }
	}
	function prof(){
		if(!($_SESSION['user_id'])|| $_SESSION['user_type']!=1 ){
			echo"<script>window.location='../index.php'</script>";
	    }
	}
	function danger(){
		if(isset($_SESSION['message'])){
			echo "<center><label class='danger'>".$_SESSION['message']."</label></center>";
		}
		unset($_SESSION['message']);
	}
	function success(){
		if(isset($_SESSION['message'])){
			echo "<center><label class='success'>".$_SESSION['message']."</label></center>";
		}
		unset($_SESSION['message']);
	}
	function redirectFailed($link){
		echo '
				<script>
				swal({ title: "Error!",
					title: "Invalid Entries!",
					icon: "error",
					type: "error"}).then(okay => {
					  if (okay) {
					   window.location.href = "'.$link.'";
					 }
				   });
				</script>
				';
	}
	function redirectSuccess($link){
		echo '
				<script>
				swal({ title: "Success!",
					title: "Success!",
					icon: "success",
					type: "success"}).then(okay => {
					  if (okay) {
					   window.location.href = "'.$link.'";
					 }
				   });
				</script>
				';
	}
	function changePass($oldpass,$pass,$pass1,$pass2){
			if($oldpass==$pass){
				if($pass1==$pass2){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
?>