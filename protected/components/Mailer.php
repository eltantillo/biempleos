<?php
    class Mailer{
        public static function sendMail($subject, $email, $company, $company_email, $message){
            $headers = "MIME-Version: 1.0\r\n"; 
            $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
            $headers .= 'From: ' . $company . ' <' . $company_email . '>' . "\r\n";
            $headers .= 'Reply-To: ' . $company_email . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();

            if (mail($email,  $subject, $message, $headers)) {
                echo Functions::cifrar("exito");
            } else {
                echo Functions::cifrar("error");
            }
    }
}
?>