<?php 
require_once "../../conn/class.php";
$db = new db_class();

session_start();

if(isset($_POST['change'])){
    if($db->updateStocksStatus($_POST['id'],$_POST['status'])){
        header('Location:../inventory.php');
    }else{
        header('Location:../inventory.php');
    }
}else{
    header('Location:../inventory.php');
}
?>