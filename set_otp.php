<?php
session_start();
include_once __DIR__."/controller/loginController.php";
if(empty($_SESSION['email']) && empty($_SESSION['logged_in'])){
    header('Location: register.php');
  }

$id=$_POST['id'];
$login_con=new loginController();
$result=$login_con->setotp($id);
if($result){
    echo "success";
}
?>