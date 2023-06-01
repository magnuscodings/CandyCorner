<?php 
require_once "../../conn/class.php";
require '../../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;
$db = new db_class();
session_start();
print_r($_POST);
if(isset($_POST['accept'])){
    if($db->updateRequestStatus($_SESSION['user_id'],$_POST['id'],3)){
        header('Location:../request.php');
    }else{
        header('Location:../request.php');
    }
}else{
    header('Location:../../');
}