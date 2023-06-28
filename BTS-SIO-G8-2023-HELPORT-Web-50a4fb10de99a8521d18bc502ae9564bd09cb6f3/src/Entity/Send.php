<?php

namespace Apps\Entity;

use Apps\Core\View\TwigCore;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Send
{
public function SendMail(string $mail, string $prenom, string $typeCompte){
    if ($typeCompte == 'A'){
        $status = 'admin';
    }
    elseif ($typeCompte == 'P'){
        $status = 'Professeur';
    }
    else {
        $status = 'Etudiant';
    }

    $phpmailer = new PHPMailer(true);
    $phpmailer->isSMTP();
    $phpmailer->Host =$_ENV['HOST'];
    $phpmailer->SMTPAuth =$_ENV['SMTPAUTH'];
    $phpmailer->Port =$_ENV['PORT'];
    $phpmailer->Username = $_ENV['USERNAME'];
    $phpmailer->Password = $_ENV['PASSWORD'];

    //Recipients
    $phpmailer->setFrom($_ENV['MAILFROM'], 'HelpOrt');
    $phpmailer->addAddress($mail, $prenom);//Add a recipient

    //Content
    $phpmailer->isHTML(true);//Set email format to HTML
    $phpmailer->Subject = 'Confirmation dincription';
    $phpmailer->Body = 'Bonjour '.$prenom.', <br> votre compte '.$status.' a bien ete enregistrer <br> bienvenue sur HelpOrt';

    $phpmailer->send();

}
}