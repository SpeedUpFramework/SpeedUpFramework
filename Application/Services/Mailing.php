<?php
namespace Services;

class Mailing{

  public function __construct(){
    $this->mail = new \PHPMailer;
  }

  public function send_mail($sujet, $body, $to){

    $this->mail->From = "contact@qvservers.fr";
    $this->mail->FromName = "QVServers";

    $this->mail->addAddress($to);


    $this->mail->IsSMTP();
    $this->mail->isHTML(true);
    $this->mail->SMTPAuth   = true;               // enable SMTP authentication
    $this->mail->Host       = "smtp.elasticemail.com"; // sets the SMTP server
    $this->mail->Port       = 2525;                    // set the SMTP port for the GMAIL server
    $this->mail->Username   = "contact@nicolas-r.fr"; // SMTP account username
    $this->mail->Password   = "91b2d8be-8167-4a23-beb6-abea3700dcc8";
           // SMTP account password
    $this->mail->Subject = $sujet;
    $this->mail->Body = $body;
    //$this->mail->AltBody = "This is the plain text version of the email content";

    if(!$this->mail->send())
    {
        echo "Mailer Error: " . $this->mail->ErrorInfo;
    }
    else
    {
        return true;
    }
  }
}
