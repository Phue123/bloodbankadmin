<?php
session_start();
include_once __DIR__.'/controller/loginController.php';
include_once __DIR__.'/controller/registerController.php';

if(empty($_SESSION['email']) && empty($_SESSION['logged_in'])){
    header('Location: login.php');
  }

$reg_con=new registerController();
$login_con=new loginController();
$email=$_SESSION['Email'];
if(isset($_POST['submit'])){
    if(empty($_POST['password']) || strlen($_POST['password']) < 4 || empty($_POST['cpassword']) || strlen($_POST['cpassword']) < 4 ){
          if (empty($_POST['password'])) {
            $passwordError='Please enter your password';
          }
          if(strlen($_POST['password']) < 4 ){
            $passwordchar='Password should be 4 characters at least';
          }
          if (empty($_POST['cpassword'])) {
            $cpasswordError='Please enter your comfirm password';
          }
          if(strlen($_POST['cpassword']) < 4 ){
            $cpasswordchar='Password should be 4 characters at least';
          }
        }else {
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $cpassword=$password;
    if($_POST['password']==$_POST['cpassword']){
    $otp_code= rand(100000, 999999);	
    $result=$login_con->setresetpassword($password,$cpassword,$email,$otp_code);
    if($result){
        $otpresult=$reg_con->getotp($email);
        $id=$otpresult['Id'];
        if($otpresult){
            
           echo '<script>location.href="verify_otp.php"</script>' ;
        }
    }
    }else{
    $matcherror="Password doesn't match";
    }
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
    <div class="container-fluid d-flex justify-content-center flex-row m-5">
        
            <div class="col-md-4">
                <h2 class="text-center">Reset Password</h2>
                <div class="card bg-light">

                    <div class="card-body">
                    <?php if(isset($matcherror)) echo "<p class='bgp rounded text-center p-2'>".$matcherror."</p>" ?>
                        <form action="" method="post">
                            <div class="m-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <?php if(isset($passwordError)){ echo '<span class="text-danger">'.$passwordError.'</span>'; }elseif(isset($passwordchar)) {echo '<span class="text-danger">'.$passwordchar.'</span>'; }?>
                            </div>
                            <div class="m-3">
                                <label for="" class="form-label">Comfirm Password</label>
                                <input type="password" name="cpassword" class="form-control" placeholder="Comfirm Password">
                                <?php if(isset($cpasswordError)) {echo '<span class="text-danger">'.$cpasswordError.'</span>';}elseif(isset($cpasswordchar)) {echo '<span class="text-danger">'.$cpasswordchar.'</span>';}  ?>
                            </div>
                            <div class="m-3">
                                <button class="btn btn-primary btn-block" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
    </div>
</body>
</html>