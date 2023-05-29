<?php 
require_once "../../conn/class.php";

$db = new db_class();
session_start();
if($_SESSION['user_type']==0){

print_r($_SESSION);
    {// Category
        if(isset($_SESSION['user_id'])){
            $status = htmlentities(5);
            $user = htmlentities($_SESSION['user_id']);
            $order_id = htmlentities($_GET['id']);
            if($status==5 && isset($_SESSION['user_id'])){
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