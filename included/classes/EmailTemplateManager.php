<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of EmailTemplateManager
 *
 * @author ziyang
 */
class EmailTemplateManager {
    //put your code here


    public function generateCustomerPasswordResetEmail($customer, $new_password) {
        $email = new Email();

        $mailBody = new EmailTemplate();
        $mailBody->loadByKey('customer_password_reset');


        // output the email template after eval() call into memory buffer
        $message = "";
        ob_start();
        eval($this->covernt_text_into_php_code($mailBody->get_email_template()));
        $message = ob_get_contents();
        ob_end_clean();

        
        $email->set_recipient($customer->get_email());
        $email->set_subject($mailBody->get_email_template_title());
        $email->set_message($message);

        return $email;
    }

    public function generateCustomerRegisterSucceedEmail($customer) {
        $email = new Email();
        
        $mailBody = new EmailTemplate();
        $mailBody->loadByKey('register_succeed');

        // output the email template after eval() call into memory buffer
        $message = "";
        ob_start();
        eval($this->covernt_text_into_php_code($mailBody->get_email_template()));
        $message = ob_get_contents();
        ob_end_clean();

        $email->set_recipient($customer->get_email());
        $email->set_subject($mailBody->get_email_template_title());
        $email->set_message($message);

        return $email;
    }

    public function generateCustomerPaymentSucceedEmail($customer, $order) {
        $email = new Email();

        $mailBody = new EmailTemplate();
        $mailBody->loadByKey('payment_successful');

        // output the email template after eval() call into memory buffer
        $message = "";
        ob_start();
        eval($this->covernt_text_into_php_code($mailBody->get_email_template()));
        $message = ob_get_contents();
        ob_end_clean();

        $email->set_recipient($customer->get_email());
        $email->set_subject($mailBody->get_email_template_title());
        $email->set_message($message);

        return $email;
    }

    private function covernt_text_into_php_code($text) {
        $text = str_replace("\"", "'", $text); // replace " with '
        $text = str_replace("++", "->", $text); // replace ++ with ->
        $text = str_replace("{{", "\".", $text);
        $text = str_replace("}}", ".\"", $text);
        $text = "print \"".$text;
        $text = $text."\";";
        return $text;
    }

    public function loadEmailTagsByEmailTemplateKey($email_template_key) {
        $count = 0;
        $emailTagList = null;
        $link = getConnection();
        $query="select 	email_tag_id,
                        tb_email_tag.email_tag_group_id,
                        email_tag_name,
                        email_tag,
                        email_tag_descirption
                from    tb_email_tag
                where tb_email_tag.email_tag_group_id in
                (
                select tb_email_tag_group.email_tag_group_id
                from   tb_email_template, tb_email_tag_group, tb_email_tamplate_to_tag_group
                where tb_email_tag_group.email_tag_group_id = tb_email_tamplate_to_tag_group.email_tag_group_id
                and   tb_email_tamplate_to_tag_group.email_template_id = tb_email_template.email_template_id
                and   tb_email_template.email_template_key = '".$email_template_key."'
                ) ";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $emailTag = new EmailTag();
            $emailTag->set_email_tag_id($newArray['email_tag_id']);
            $emailTag->set_email_tag_name($newArray['email_tag_name']);
            $emailTag->set_email_tag($newArray['email_tag']);
            $emailTag->set_email_tag_description($newArray['email_tag_descirption']);
            $emailTagList[$count] = $emailTag;
            $count++;
        }
        return $emailTagList;
    }

    public function loadEmailTagsByEmailTemplateID($email_template_id) {
        $count = 0;
        $emailTagList = null;
        $link = getConnection();
        $query="select 	email_tag_id,
                        tb_email_tag.email_tag_group_id,
                        email_tag_name,
                        email_tag,
                        email_tag_descirption
                from    tb_email_tag
                where tb_email_tag.email_tag_group_id in
                (
                select tb_email_tag_group.email_tag_group_id
                from   tb_email_template, tb_email_tag_group, tb_email_tamplate_to_tag_group
                where tb_email_tag_group.email_tag_group_id = tb_email_tamplate_to_tag_group.email_tag_group_id
                and   tb_email_tamplate_to_tag_group.email_template_id = tb_email_template.email_template_id
                and   tb_email_template.email_template_id = ".$email_template_id."
                ) ";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $emailTag = new EmailTag();
            $emailTag->set_email_tag_id($newArray['email_tag_id']);
            $emailTag->set_email_tag_name($newArray['email_tag_name']);
            $emailTag->set_email_tag($newArray['email_tag']);
            $emailTag->set_email_tag_description($newArray['email_tag_descirption']);
            $emailTagList[$count] = $emailTag;
            $count++;
        }
        return $emailTagList;
    }

    public function getEmailTemplateList() {
    $emailTemplateList = null;
    $count = 0;
        $link = getConnection();
        $query="select 	email_template_id,
                        email_template_key,
                        email_template_title,
                        email_template,
                        email_template_comment
                from    tb_email_template ";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $emailTemplate = new EmailTemplate();
            $emailTemplate->set_email_template_id($newArray['email_template_id']);
            $emailTemplate->set_email_template_key($newArray['email_template_key']);
            $emailTemplate->set_email_template_title($newArray['email_template_title']);
            $emailTemplate->set_email_template($newArray['email_template']);
            $emailTemplate->set_email_template_comment($newArray['email_template_comment']);

            $emailTemplateList[$count] = $emailTemplate;
            $count++;
        }

        return $emailTemplateList;
}
}
?>
