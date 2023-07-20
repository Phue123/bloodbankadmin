<?php 
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['logged_in'])){
    header('Location: login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Succcessfully login</h2>
    <a href="logout.php" class="btn btn-danger">Lagout</a>
</body>
</html>