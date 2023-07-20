<?php
session_start();
include_once __DIR__.'/controller/registerController.php';

if(empty($_SESSION['email']) && empty($_SESSION['logged_in'])){
    header('Location: register.php');
  }

$id=$_SESSION['otp_Id'];

$reg_con=new registerController();
$otpresult=$reg_con->getinfobyid($id);
$oid=$otpresult['Id'];

if(isset($_POST['submit'])){
    $otp=$_POST['otp'];
    if(empty($_POST['otp'])){
        $otperror="Invalid otp number";
    }else
    if($otp == $otpresult['otp_code']){
        echo '<script>location.href="login.php"</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/mycss.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-row mt-5">

            <div class="col-md-5">
                <h2 class="text-center">OTP Verification</h2>
                
                <div class="card bg-light">
                    <div class="card-body">
                    <?php
                    if(isset($_GET['status'])){
                        echo "<p class='bgs rounded text-center p-2'>We've sent a vertification code to your email- '".$otpresult['Email']."'</p>";
                    }
                    ?>
                        <form action="" method="post">
                            <div class="mt-3">
                                <input type="number" name="otp" class="form-control" placeholder="Enter verification code">
                                <p style="color:red"><?php echo empty($otperror) ? '' : '*'.$otperror; ?></p>
                            </div>
                            <div class="mt-3" id="<?php echo $oid; ?>">
                                <button class="btn btn-primary btn-block vbtn" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
    </div>
</body>
<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/myscript.js"></script>
</html>