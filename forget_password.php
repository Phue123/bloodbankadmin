<?php
session_start();
include_once __DIR__.'/controller/loginController.php';

$login_con=new loginController();
if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
        $emailerror="Please fill your email";
    }else{

        $email=$_POST['email'];
        $result=$login_con->getinfobyemail($email);
        if($result){
         echo '<script>location.href="reset_password.php"</script>';
        }
        else{
            $mailerror="Email doesn't exit";
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
                <h2 class="text-center">Forget Password</h2>
                <div class="card bg-light">

                    <div class="card-body">
                    <?php if(isset($mailerror)) echo "<p class='bgp rounded text-center p-2'>".$mailerror."</p>" ?>
                        <form action="" method="post">
                            <div class="m-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter your email">
                                <?php if(isset($emailerror)) echo '<span class="text-danger">'.$emailerror.'</span>' ?>
                            </div>
                            <div class="m-3">
                                <button class="btn btn-primary btn-block" name="submit">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
    </div>
</body>
</html>