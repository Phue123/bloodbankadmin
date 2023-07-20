<?php
include_once __DIR__."/../vendor/db/db.php";

class login{
    public function getuserinfobyemail($email){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT Name,Email,Password,verify_otp,otp_code from user where email=:email";
        $statement=$con->prepare($sql);
        $statement->BindParam(':email',$email);
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getuserinfo(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT Name,Email,Password from user";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function setotpinfo($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="Update user set verify_otp=1 where Id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam(':id',$id);
        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function updatepassword($password,$cpassword,$email,$otp_code){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="Update user set Password=:password,Cpassword=:cpassword,otp_code=:otp_code,verify_otp=0 where Email=:email";
        $statement=$con->prepare($sql);
        $statement->BindParam(':password',$password);
        $statement->BindParam(':cpassword',$cpassword);
        $statement->BindParam(':email',$email);
        $statement->BindParam(':otp_code',$otp_code);
        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>