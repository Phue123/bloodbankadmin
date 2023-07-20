<?php
session_start();
include_once __DIR__.'/controller/loginController.php';

$login_con=new loginController();

if(isset($_POST['submit'])){
    if(empty($_POST['email']) || strlen($_POST['password']) < 4){
        if (empty($_POST['email'])) {
            $emailError='Please enter your email';
          }
          if (empty($_POST['password'])) {
            $passwordError='Please enter your password';
          }
          if(strlen($_POST['password']) < 4 ){
            $passwordError='Password should be 4 characters at least';
          }
        }else {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $result=$login_con->getinfobyemail($email);
    if($result){
        if(password_verify($password,$result['Password']) && $result['verify_otp']==1){
            $_SESSION['email']=$result['Email'];
            $_SESSION['Logged_in']=time();
            echo '<script>location.href="index.php"</script>';
            
        }
        else{
            // $loginerror="It's looks like you are not a menber Click on the bottom link to Sign up";
            echo "<script>alert('Incorrect credentials')</script>";
            echo '<script>location.href="verify_otp.php"</script>';
        }
    }
    else{
        $loginerror="It's looks like you are not a member.<br>Click on the bottom link to <a href='register.php'>Sign up</a>";
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
                <h2 class="text-center">Login Page</h2>
                <div class="card bg-light">

                    <div class="card-body">
                        <p>Sign in to start your session</p>
                        <?php if(isset($loginerror)) echo "<p class='bgp rounded text-center p-2'>".$loginerror."</p>" ?>
                        <form action="" method="post">
                            <div class="m-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <p style="color:red"><?php echo empty($emailError) ? '' : '*'.$emailError; ?></p>
                            </div>
                            <div class="m-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <p style="color:red"><?php echo empty($passwordError) ? '' : '*'.$passwordError; ?></p>
                                <a href="forget_password.php">Forget Password?</a>
                            </div>
                            <div class="m-3">
                                <button class="btn btn-primary btn-block" name="submit">Login</button>
                                <p class="text-center">Not a member?  <a href="register.php">Sign Up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
    </div>
</body>
</html>