<?php 
session_start();
require_once "../conn/class.php";
$db = new db_class();

// Registration
if(isset($_POST['register'])){
    try {
        if($db->insertUser($_POST['email'],$_POST['password'],$_POST['name'],'0')){
            echo '2';
        }else{
            echo '1';
        }
    } catch (\Throwable $th) {
       echo '3';
    }
}

// Login
if(isset($_POST['login'])){
    try {
        $get_id= $db->login($_POST['email'],$_POST['password']);
        	if($get_id['count'] > 0){
                $_SESSION['user_id']=$get_id['u_id'];
                $_SESSION['user_type']=$get_id['u_type'];
                 $_SESSION['user_email'] = $get_id['u_email'];
                if($get_id['u_type']==0){
                    echo '0';
                }else if($get_id['u_type']==1){
                    echo '1';
                }else if($get_id['u_type']==2){
                    echo '2';
                }else{
                    echo '3';
                }
                
            }else{
                echo '3';
            }
    } catch (\Throwable $th) {
       echo '3';
    }
    
}