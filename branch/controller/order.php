<?php 
require_once "../../conn/class.php";
$db = new db_class();

session_start();
print_r($_POST);
if(isset($_POST['cancelorder'])){

    $user_id = $_SESSION['user_id'];
    $id = $_POST['id'];
    $reason = $_POST['reason'];
    $status = 1;
    $type = 0;

    if($db->updateStatusOrder($user_id,$id,$status) && $db->insertOrderCancelRecords($user_id,$reason,$type,$id) ){
        header('Location:../orders.php');
    }else{
        header('Location:../orders.php');
    }
}else{
    header('Location:../orders.php');
}
?>