<?php

  /*
   *Mail class uses phpmailer to send mail with specified headers.
  */

  class Mail
  {
    private $mail;

    function __construct() {

      require_once("phpmailer/PHPMailerAutoload.php");

      $this->mail = new PHPMailer;

      $this->mail->SMTPDebug = 1;                                 // Enable verbose debug output

      $this->mail->isSMTP();                                      // Set mailer to use SMTP
      $this->mail->Host = 'ssl://smtp.gmail.com';                 // Specify main and backup SMTP servers
      $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
      $this->mail->Username = 'sankalpatimilsina12@gmail.com';    // SMTP username
      $this->mail->Password = '*********************';            // SMTP password
      $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $this->mail->Port = 465;                                    // TCP port to connect ti

      $this->mail->setFrom($from, '');
      $this->mail->addAddress($to, '');                           // Add a recipient
      $this->mail->isHTML(true);                                  // Set email format to HTML

      $this->mail->Subject = $subject;
      $this->mail->Body    = $message;

    }

    function sendMail() {

      if(!$this->mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $this->mail->ErrorInfo;
      }
    }

    function __destruct() {

    }

  }

?>

