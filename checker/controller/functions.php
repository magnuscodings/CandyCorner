<?php 
require_once "../../conn/class.php";
$db = new db_class();

{// Category
    if(isset($_POST['addCategory'])){

        try {
            if($db->insertCategory($_POST['name'])){
                echo '2';
            }else{
                echo '1';
            }
        } catch (\Throwable $th) {
           echo '3';
        }
    }
    if(isset($_POST['checker'])){
    
        try {
            if($db->updateStocks($_POST['status'],$_POST['id']) && $db->insertInventoryRecords($_POST['status'],$_POST['id'],$_POST['order_id']) ){
                echo '2';
            }else{
                echo '1';
            }
        } catch (\Throwable $th) {
           echo '3';
        }
    }
    if(isset($_POST['deleteCategory'])){
    
        try {
            if($db->deactivateCategory($_POST['id'])){
                echo '2';
            }else{
                echo '1';
            }
        } catch (\Throwable $th) {
           echo '3';
        }
    }
}//End Category
