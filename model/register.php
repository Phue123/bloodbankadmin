<?php

include_once __DIR__."/../vendor/db/db.php";

class Register{
    public function setuserinfo($name,$email,$password,$comfirm_password,$otp_code){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT into user(Name,Email,Password,Cpassword,otp_code) VALUES(:name,:email,:password,:cpassword,:otp_code)";
        $statement=$con->prepare($sql);
        $statement->BindParam('name',$name);
        $statement->BindParam('email',$email);
        $statement->BindParam('password',$password);
        $statement->BindParam('cpassword',$comfirm_password);
        $statement->bindParam('otp_code',$otp_code);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getotpbyemail($email){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from user where Email=:email";
        $statement=$con->prepare($sql);
        $statement->BindParam('email',$email);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }

    public function getuserinfobyid($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from user where id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam('id',$id);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }
}
?>