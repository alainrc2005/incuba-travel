<?php

/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/22/2017
 * Time: 1:47 PM
 */
class ICTEmail
{
    function __construct() {
        log_message('debug', "PHPMailer Class Initialized");
    }

    public function sendEmail($fromname, $sender, $recipients, $subject, $message, $attachment = NULL, $attachName = NULL) {
        $mail = new PHPMailer();
        $mail->Host = ini_get('SMTP');
        $mail->Port = ini_get('smtp_port');
        $mail->isSMTP();
        $mail->isMail();

        $mail->setFrom($sender, $fromname);
        $mail->Subject = $subject;
        $mail->AltBody = strip_tags($message);
        $mail->MsgHTML($message);
        foreach (explode(";", $recipients) as $recipient)
            $mail->AddAddress($recipient);
        $mail->addBCC('alainrc2005@gmail.com');
        if ($attachment && $attachName)
            $mail->addStringAttachment($attachment, $attachName);
        return $mail->Send();
    }
}