<?php 
require_once "../../conn/class.php";
require '../../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;
$db = new db_class();
session_start();
if($_SESSION['user_type']==2){
    {// Category
        if(isset($_GET['status'])){
            $status = htmlentities($_GET['status']);
            $user = htmlentities($_GET['user']);
            $order_id = htmlentities($_GET['id']);
            if($status==2 || $status==1 || $status==4){
                if($db->insertOrderRecords($user,$order_id,$status) && $db->updateStatusOrder($user,$order_id,$status)){
                    header('Location:../orders.php');
                }else{
                    header('Location:../orders.php');
                }
            }else{
                header('Location:../../');
            }
        
        }else{
            header('Location:../../');
        }
        
    }    
}else{
    header('Location:../../');
}