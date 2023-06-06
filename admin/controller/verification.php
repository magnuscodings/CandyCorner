<?php 
require_once "../../conn/class.php";
$db = new db_class();

session_start();
// print_r($_POST);
if(isset($_POST['change'])){
    if($db->updateUserStatus($_POST['id'],2)){
        header('Location:../verification.php');
    }else{
        header('Location:../verification.php');
    }
}if(isset($_POST['decline'])){
    if($db->updateUserStatus($_POST['id'],1)){
        header('Location:../verification.php');
    }else{
        header('Location:../verification.php');
    }
}else{
    header('Location:../verification.php');
}
?>