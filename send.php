<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if(isset($_POST['send'])){
    $email = $_POST['email'];
    // $subject = $_POST['subject'];
    $message = $_POST['message'];    
    $name = $_POST['name'];
    $eType = $_POST['eventType'];
    $tEvent = $_POST['typeEvent'];
    $eGuest = $_POST['expectedGuest'];
    $subject = 'Im requesting an '.$tEvent.' '.$eType;
    $filename = $_FILES['attachment']['name'];
    $location = 'attachment/' . $filename;
    move_uploaded_file($_FILES['attachment']['tmp_name'], $location);

    //Load composer's autoloader
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '123archiel@gmail.com';     // Your Email/ Server Email
        $mail->Password = '01archiel';                     // Your Password
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        //Send Email
        $headers .= "Reply-To: no-reply@abc.com \r\n";
        // $mail->setFrom('jaspertabang27@yahoo.com');
        $mail->setFrom($email);
        //Recipients
        // $mail->addAddress($email);  // if you want to send something to the client
        $mail->addAddress('ledwallpamp@gmail.com');     
        // $mail->addAddress('joe@example.net', 'Joe User');          
        $mail->addReplyTo('123archielgmail.com','Archiel Curzada');
        
        //Attachment
        if(!empty($filename)){
            $mail->addAttachment($location, $filename); 
        }
       
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail ->Body ='<html><body> ';

               // $mail ->Body .='<b><strong>Client Email:</strong></b>'.' '.$email;
                // $mail ->Body .='<br/><br/>';
                $mail ->Body .='<h1> Requesting an '.$tEvent.' '.$eType.'<h1>';
                $mail ->Body .='<h3>Client Request Details:</h3>';
                $mail ->Body .='<b><strong>From:</strong></b>'.' '.$name.' [mailto:'.$email.']';
                $mail ->Body .='<br/>';
                $mail ->Body .='<b><strong>Subject:</strong></b>'.' '.$subject;
                 $mail ->Body .='<br/>';
                $mail ->Body .='<b><strong>Type of Event:</strong></b>'.' '.$tEvent;
                  $mail ->Body .='<br/>';
                // $mail ->Body .='<br/><br/>';
                $mail ->Body .='<b><strong>Client Event Type:</strong></b>'.' '.$eType;
                $mail ->Body .='<br/>';
                $mail ->Body .='<b><strong>Estimated Guest(s):</strong></b>'.' '.$eGuest;
                $mail ->Body .='<br/><br/>';
                $mail ->Body .='<b><strong>Your Ideal Event:</strong></b>';
                $mail ->Body .='<br/>';
                $mail ->Body .= '<i>'.$message.'</i>';

$mail ->Body .='</html></body>';

        $mail->send();
$messageY = "Message SENT MOTHER FUCKER!";
$messageX = "Not sent.. please rethink your code or your life you scum!";
        
echo "<script type='text/javascript'>
alert('$messageY');
 window.location.replace('index.php');</script>";
}catch (Exception $e) {
echo "<script type='text/javascript'>
alert('$messageX');
 window.location.replace('index.php');</script>";
 }

}//end isset


    ?>