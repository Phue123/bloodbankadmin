<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once __DIR__.'/../model/register.php';
include_once __DIR__.'/../vendor/PHPMailer/src/PHPMailer.php';
include_once __DIR__.'/../vendor/PHPMailer/src/SMTP.php';
include_once __DIR__.'/../vendor/PHPMailer/src/Exception.php';

class registerController extends Register{
    public function setuser($name,$email,$password,$comfirm_password,$otp_code){
        return $this->setuserinfo($name,$email,$password,$comfirm_password,$otp_code);
    }
    public function getotp($email){
        $otp=$this->getotpbyemail($email);
        $mailer=new PHPMailer(true);

        //Server setting
        $mailer->SMTPDebug=SMTP::DEBUG_SERVER;
        $mailer->isSMTP();
        $mailer->Host='smtp.gmail.com';
        $mailer->SMTPAuth=true;
        $mailer->SMTPSecure='tls';
        $mailer->Port=587;

        //Mail setting
        $mailer->Username="phuepwint293989@gmail.com";
        $mailer->Password="zwszunlpdalwfwqe";

        $mailer->SetFrom('phuepwint293989@gmail.com','Admin');
        $mailer->addAddress('phuepwint293989@gmail.com',"TraineeName");

        $mailer->isHTML(true);
        $mailer->Subject="Verification for your register";
        $mailer->Body="Your verification code is".$otp['otp_code'];
        if($mailer->send()){
           return $otp;
    }
   }

   public function getinfobyid($id){
    return $this->getuserinfobyid($id);
   }
}


?>