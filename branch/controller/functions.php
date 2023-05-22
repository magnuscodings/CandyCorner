<?php 
session_start();
require_once "../../conn/class.php";
require '../../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;
$db = new db_class();

{// Category
    if(isset($_POST['addCart'])){

        try {
            if($db->insertCart($_POST['id'],$_SESSION['user_id'],$_POST['quantity'])){
                echo '2';
            }else{
                echo '1';
            }
        } catch (\Throwable $th) {
           echo '3';
        }
    }
    if(isset($_POST['editCategory'])){
    
        try {
            if($db->updateCategory($_POST['name'],$_POST['id'])){
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

function generateCode(){
    return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

}