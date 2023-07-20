<?php
include_once __DIR__.'/../model/login.php';

class loginController extends login{
    public function getuser()
    {
        return $this->getuserinfo();
    }
    public function getinfobyemail($email){
        return $this->getuserinfobyemail($email);
    }
    public function setotp($id){
        return $this->setotpinfo($id);
    }
    
    public function setresetpassword($password,$cpassword,$email,$otp_code){
        return $this->updatepassword($password,$cpassword,$email,$otp_code);
    }
}
?>