<?php
session_start();
include_once __DIR__.'/controller/registerController.php';
include_once __DIR__."/controller/loginController.php";

$log_con=new loginController();
$reg_con=new registerController();
if(isset($_POST['submit'])){
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['comfirm_password']) || strlen($_POST['password']) < 4) {
        if(empty($_POST['name'])){
          $nameError='Please enter your name';
        }
        if (empty($_POST['email'])) {
          $emailError='Please enter your email';
        }
        if (empty($_POST['password'])) {
          $passwordError='Please enter your password';
        }
        if (empty($_POST['comfirm_password'])) {
            $passwordError='Please enter your comfirm password';
          }
        if(strlen($_POST['password']) < 4 ){
          $passwordError='Password should be 4 characters at least';
        }
      }else {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $comfirm_password=$password;
    $user=$log_con->getinfobyemail($email);
    if($user){
        $erroremail="Email Duplicated";
    }
    else if($_POST['password']==$_POST['comfirm_password']){
    $otp_code= rand(100000, 999999);	
    $result=$reg_con->setuser($name,$email,$password,$comfirm_password,$otp_code);
    if($result){
        $otpresult=$reg_con->getotp($email);
       $id=$otpresult['Id'];
        if($otpresult){
            $_SESSION['otp_Id']=$otpresult['Id'];
            $_SESSION['Loggedin']=time();
           echo '<script>location.href="verify_otp.php"</script>' ;
        }
    }
    }else{
        $matcherror="Comfirm password doesn't match!";
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
    <div class="container d-flex justify-content-center align-items-center flex-row mt-5">

            <div class="col-md-5">
                <h2 class="text-center">Register Page</h2>
                
                <div class="card bg-light">

                    <div class="card-body">
                        <p class="align-center">Sign up to start your session</p>
                        <?php if(isset($message)) echo "<p class='bgs rounded text-center p-2'>".$message."</p>" ?>
                        <?php if(isset($erroremail)) echo "<p class='bgp rounded text-center p-2'>".$erroremail."</p>" ?>
                        <?php if(isset($matcherror)) echo "<p class='bgp rounded text-center p-2'>".$matcherror."</p>" ?>
                        <form action="" method="post">
                            <div class="m-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name">
                                <p style="color:red"><?php echo empty($nameError) ? '' : '*'.$nameError; ?></p>
                            </div>
                            <div class="m-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <p style="color:red"><?php echo empty($emailError) ? '' : '*'.$emailError; ?></p>
                            </div>
                            <div class="m-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <p style="color:red"><?php echo empty($passwordError) ? '' : '*'.$passwordError; ?></p>
                            </div>
                            <div class="m-3">
                                <label for="" class="form-label">Comfirm Password</label>
                                <input type="password" name="comfirm_password" class="form-control" placeholder="Comfirm Password">
                                <p style="color:red"><?php echo empty($passwordError) ? '' : '*'.$passwordError; ?></p>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success btn-block" name="submit">Register</button>
                                <p class="text-center">Already a member?  <a href="login.php">Login here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
    </div>
</body>
</html>