<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//use PHPMailer\PHPMailer\Exception;
//require 'PHPMailer-master/PHPMailerAutoload.php';
require('../PHPMailer-master/src/Exception.php');
require('../PHPMailer-master/src/PHPMailer.php');
require('../PHPMailer-master/src/SMTP.php');
include('../Core/User.php');
if(isset($_POST['submit']))
{   $email=$_POST['email'];
    //echo $email;
    $password="";
    $liste="";
    $sql = "SELECT password FROM user where email='$email'";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        foreach($liste as $list)
        {
           $password=$list['password'];
            
         }
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }
    
    echo $password;
    $mail=new PHPMailer;
    //$mail->SMTPDebug =SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth= true;
    $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
    
    $mail->Username='abidmahmoud13.18@gmail.com';
    $mail->Password='klrqaukmxndsynnq';
    //$mail->SMTPSecure='ssl';
    $mail->Port=587;
    $mail->setFrom("exmple@gmail.com");
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject="Requperation password ";
    $mail->Body="Your password is : ".$password;
    $mail->send();
     if(!$mail->send())
     {
         echo "mail error is : ". $mail->ErrorInfo;
     }
     else
     {
        header('Location: ../View/LoginPage.php');
     }

}
?>