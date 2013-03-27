<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of EmailSender
 *
 * @author ziyang
 */
class EmailSender {
    private $_smtp_host;
    private $_smtp_user;
    private $_password;
    private $_mail_from;
    private $_smtp_port;
    private $_company_name;



    function __construct() {
        $configManager = new ConfigurationManager();

        $this->_smtp_host = $configManager->getValueByKey("email_host");
        $this->_smtp_user = $configManager->getValueByKey("email_user");
        $this->_password = $configManager->getValueByKey("email_password");
        $this->_mail_from = $configManager->getValueByKey("email_sender");
        $this->_smtp_port = $configManager->getValueByKey("email_port");

        $this->_company_name  = $configManager->getValueByKey("shop_name");
    }


//
// parse server with socket number
//
    private function server_parse($socket, $expected_response) {
        $server_response = '';
        while (substr($server_response, 3, 1) != ' ') {
            if (!($server_response = fgets($socket, 256)))
                echo "Couldn\'t get mail server response codes. Please contact the  administrator.";
        }

        if (!(substr($server_response, 0, 3) == $expected_response))
            echo "Unable to send e-mail. Please contact the administrator with the following error message reported by the SMTP server: ".$server_response;
    }


    function smtp_mail($to, $subject, $message ) {
        $recipients = explode(',', $to);

        $headers  = 'MIME-Version: 1.0' . "\r\n"."Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'From: '.$this->_company_name .' <'.$this->_mail_from.'>' . "\r\n";

        //$configurationManager = new ConfigurationManager();
        $smtp_host= $this->_smtp_host; //"mail.mydreamland.co.uk";
        $smtp_user= $this->_smtp_user; //"test+mydreamland.co.uk";
        $smtp_password= $this->_password; //"19840617";
        $mail_from= $this->_mail_from; //"test@mydreamland.co.uk";
        $smtp_port = $this->_smtp_port; //2626;


        if (!($socket = fsockopen($smtp_host, $smtp_port, $errno, $errstr, 15)))
            echo "Could not connect to smtp host ";  //.$smtp_address." (".$errno.") (".$errstr.")";

        $this->server_parse($socket, '220');

        if ($smtp_user != '' && $smtp_password != '') {
            fwrite($socket, 'EHLO '.$smtp_host."\r\n");
            $this->server_parse($socket, '250');

            fwrite($socket, 'AUTH LOGIN'."\r\n");
            $this->server_parse($socket, '334');

            fwrite($socket, base64_encode($smtp_user)."\r\n");
            $this->server_parse($socket, '334');

            fwrite($socket, base64_encode($smtp_password)."\r\n");
            $this->server_parse($socket, '235');
        }
        else {
            fwrite($socket, 'HELO '.$smtp_host."\r\n");
            $this->server_parse($socket, '250');
        }

        fwrite($socket, 'MAIL FROM: <'.$mail_from.'>'."\r\n");
        $this->server_parse($socket, '250');

        $to_header = 'To: ';

        @reset($recipients);
        while (list(, $email) = @each($recipients)) {
            fwrite($socket, 'RCPT TO: <'.$email.'>'."\r\n");
            $this->server_parse($socket, '250');

            $to_header .= '<'.$email.'>, ';
        }

        fwrite($socket, 'DATA'."\r\n");
        $this->server_parse($socket, '354');

        fwrite($socket, 'Subject: '.$subject."\r\n".$to_header."\r\n".$headers."\r\n\r\n".$message."\r\n");

        fwrite($socket, '.'."\r\n");
        $this->server_parse($socket, '250');

        fwrite($socket, 'QUIT'."\r\n");
        fclose($socket);

        return true;
    }


    function validateEmail($email) {
        $result=ereg("^[^@ ]+@[^@ ]+\.[^@ ]+$",$email,$trashed);
        return $result;
    }


}
?>
