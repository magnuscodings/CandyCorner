<?php 
require_once "../../conn/class.php";
require '../../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;
$db = new db_class();
{
    if(isset($_POST['addBranch'])){

        try {
            if($db->insertUser($_POST['email'],$_POST['password'],$_POST['name'],0,2)){
                echo '2';
            }else{
                echo '1';
            }
        } catch (\Throwable $th) {
           echo '3';
        }
    }
    if(isset($_POST['deleteBranch'])){

        try {
            if($db->updateUserStatus($_POST['id'],1)){
                echo '2';
            }else{
                echo '1';
            }
        } catch (\Throwable $th) {
           echo '3';
        }
    }
}


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

{// Products
    if(isset($_POST['addProduct'])){

        try {
            if($db->insertProducts($_POST['name'],$_POST['category'],$_POST['description'],$_POST['price'])){
                echo '2';
            }else{
                echo '1';
            }
        } catch (\Throwable $th) {
           echo '3';
        }
    }
    if(isset($_POST['editProduct'])){

        try {
            if($db->updateProducts($_POST['id'],$_POST['name'],$_POST['category'],$_POST['description'],$_POST['price'])){
                echo '2';
            }else{
                echo '1';
            }
        } catch (\Throwable $th) {
           echo '3';
        }
    }
    if(isset($_POST['deleteProduct'])){

        try {
            if($db->deactivateProducts($_POST['id'])){
                echo '2';
            }else{
                echo '1';
            }
        } catch (\Throwable $th) {
           echo '3';
        }
    }
    if(isset($_POST['addStocks'])){

        for ($i=1; $i <=$_POST['quantity'] ; $i++) { 
    // Create a new instance of the BarcodeGeneratorPNG class
    $generator = new BarcodeGeneratorPNG();
    // Set the barcode content
    $barcodeContent = $_POST['stocks_id'].'-'.$_POST['stocks_name'].'-'.generateCode();
    // Generate the barcode image data
    $barcodeData = $generator->getBarcode($barcodeContent, $generator::TYPE_CODE_128);
    $path="../../assets/img/barcode/";
    // Save the barcode image to a file
    $name=$barcodeContent.'.png';
    $file=$path.$name;
    file_put_contents($file, $barcodeData);
    $db->insertStocks($_POST['stocks_id'],$name);
  }
  echo '2';

        

    }
}//End Products

function generateCode(){
    return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

}