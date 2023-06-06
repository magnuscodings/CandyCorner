<?php 
require_once "../../conn/class.php";
require '../../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;
$db = new db_class();
session_start();
// print_r($_POST);
if(isset($_POST['accept'])){
    if($db->insertRequestDelivery($_POST['user_id'],$_POST['id'],$_POST['date']) && $db->updateRequestStatus($_POST['user_id'],$_POST['id'],2)){
        header('Location:../request.php');
    }else{
        header('Location:../request.php');
    }
}elseif(isset($_POST['delete'])){
    if($db->updateRequestStatus($_POST['user_id'],$_POST['id'],1)){
        header('Location:../request.php');
    }else{
        header('Location:../request.php');
    }
}elseif(isset($_POST['actionaccept'])){
    if($db->updateRequestStatus($_POST['user_id'],$_POST['id'],4) && $db->insertPulloutRecords($_POST['user_id'],$_POST['id'],$_POST['qty']) ){
        header('Location:../request.php');
    }else{
        header('Location:../request.php');
    }
}else{
    header('Location:../../');
}