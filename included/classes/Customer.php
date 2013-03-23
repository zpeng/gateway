<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Customer
 *
 * @author ziyang
 */
class Customer {
    //put your code here
    private $_customer_id;
    private $_email;
    private $_password;
    private $_firstname;
    private $_lastname;

    private $_telephone;
    private $_mobile;
    private $_newsletter;

    private $_last_edit_time;
    private $_last_visit_time;
    private $_register_date;

    private $_archived;

    public function get_customer_id() {
        return $this->_customer_id;
    }

    public function set_customer_id($_customer_id) {
        $this->_customer_id = $_customer_id;
    }

    public function get_email() {
        return $this->_email;
    }

    public function set_email($_email) {
        $this->_email = $_email;
    }

    public function get_password() {
        return $this->_password;
    }

    public function set_password($_password) {
        $this->_password = $_password;
    }

    public function get_firstname() {
        return $this->_firstname;
    }

    public function set_firstname($_firstname) {
        $this->_firstname = $_firstname;
    }

    public function get_lastname() {
        return $this->_lastname;
    }

    public function set_lastname($_lastname) {
        $this->_lastname = $_lastname;
    }

    public function get_full_name() {
        return $this->_firstname.' '. $this->_lastname;
    }

    public function get_telephone() {
        return $this->_telephone;
    }

    public function set_telephone($_telephone) {
        $this->_telephone = $_telephone;
    }

    public function get_mobile() {
        return $this->_mobile;
    }

    public function set_mobile($_mobile) {
        $this->_mobile = $_mobile;
    }

    public function get_newsletter() {
        return $this->_newsletter;
    }

    public function set_newsletter($_newsletter) {
        $this->_newsletter = $_newsletter;
    }

    public function get_newsletter_as_icon() {
        $field = "";
        if ($this->_newsletter == 'Y') {
            $field = $field."<img border='0' width='15' height='15' src='images/green_status.png'/>";
        }else {
            $field = $field."<img border='0' width='15' height='15' src='images/status-offline.png'/>";
        }
        return $field;
    }

    public function get_last_edit_time() {
        return $this->_last_edit_time;
    }

    public function set_last_edit_time($_last_edit_time) {
        $this->_last_edit_time = $_last_edit_time;
    }

    public function get_last_visit_time() {
        return $this->_last_visit_time;
    }

    public function set_last_visit_time($_last_visit_time) {
        $this->_last_visit_time = $_last_visit_time;
    }

    public function get_register_date() {
        return $this->_register_date;
    }

    public function set_register_date($_register_date) {
        $this->_register_date = $_register_date;
    }


    public function get_archived() {
        return $this->_archived;
    }

    public function set_archived($_archived) {
        $this->_archived = $_archived;
    }



    public function loadById($customer_id) {
        $link = getConnection();
        $query="select 	customer_id,
                        customer_password,
                        customer_email,
                        customer_firstname,
                        customer_lastname,
                        customer_telephone,
                        customer_mobile,
                        customer_newsletter,
                        customer_last_edit,
                        customer_last_visit,
                        customer_register_date,
                        customer_archived
                from 	tb_customer
                where   customer_id =  ".$customer_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_customer_id($newArray['customer_id']);
            $this->set_password($newArray['customer_password']);
            $this->set_email($newArray['customer_email']);
            $this->set_firstname($newArray['customer_firstname']);
            $this->set_lastname($newArray['customer_lastname']);
            $this->set_telephone($newArray['customer_telephone']);
            $this->set_mobile($newArray['customer_mobile']);
            $this->set_newsletter($newArray['customer_newsletter']);
            $this->set_last_edit_time($newArray['customer_last_edit']);
            $this->set_last_visit_time($newArray['customer_last_visit']);
            $this->set_register_date($newArray['customer_register_date']);
            $this->set_archived($newArray['customer_archived']);
        }
    }

    public function loadByEmail($_email) {
        $link = getConnection();
        $query="select 	customer_id,
                        customer_password,
                        customer_email,
                        customer_firstname,
                        customer_lastname,
                        customer_telephone,
                        customer_mobile,
                        customer_newsletter,
                        customer_last_edit,
                        customer_last_visit,
                        customer_register_date,
                        customer_archived
                from 	tb_customer
                where   customer_email =  '".$_email."'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_customer_id($newArray['customer_id']);
            $this->set_password($newArray['customer_password']);
            $this->set_email($newArray['customer_email']);
            $this->set_firstname($newArray['customer_firstname']);
            $this->set_lastname($newArray['customer_lastname']);
            $this->set_telephone($newArray['customer_telephone']);
            $this->set_mobile($newArray['customer_mobile']);
            $this->set_newsletter($newArray['customer_newsletter']);
            $this->set_last_edit_time($newArray['customer_last_edit']);
            $this->set_last_visit_time($newArray['customer_last_visit']);
            $this->set_register_date($newArray['customer_register_date']);
            $this->set_archived($newArray['customer_archived']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = " insert into tb_customer (
                    customer_password,
                    customer_email,
                    customer_firstname,
                    customer_lastname,
                    customer_telephone,
                    customer_mobile,
                    customer_newsletter,
                    customer_last_edit,
                    customer_last_visit,
                    customer_register_date,
                    customer_archived
                    )values (
                    '".$this->get_password()."',
                    '".$this->get_email()."',
                    '".$this->get_firstname()."',
                    '".$this->get_lastname()."',
                    '".$this->get_telephone()."',
                    '".$this->get_mobile()."',
                    '".$this->get_newsletter()."',
                    now(),
                    now(),
                    now(),
                    'N')";

        executeUpdateQuery($link , $query);
        $customer_id = mysql_insert_id($link);
        closeConnection($link);

        $this->set_customer_id($customer_id);
        return $customer_id;
    }

    public function delete() {
        $link = getConnection();
        $query = "  UPDATE tb_customer
                    SET    customer_archived = 'Y'
                    WHERE  customer_id    = ".$this->get_customer_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function updateCustomerDetail() {
        $link = getConnection();
        $query = "UPDATE tb_customer
                  SET    customer_firstname          = '".$this->get_firstname()."',
                         customer_lastname           = '".$this->get_lastname()."',
                         customer_telephone          = '".$this->get_telephone()."',
                         customer_mobile             = '".$this->get_mobile()."',
                         customer_newsletter         = '".$this->get_newsletter()."',
                         customer_last_edit          = now()
                   WHERE customer_id                 = ".$this->get_customer_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function updateCustomerPassword() {
        $link = getConnection();
        $query = "UPDATE tb_customer
                  SET    customer_password          = '".$this->get_password()."',
                         customer_last_edit          = now()
                   WHERE customer_id                 = ".$this->get_customer_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function load_billing_address() {
        $link = getConnection();
        $query="select 	customer_id,
                        address_type,
                        recipients,
                        street,
                        city,
                        postcode,
                        state,
                        country
                from	tb_address
                where   customer_id = ".$this->get_customer_id()."
                and     address_type = 'billing'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);
        $address = new Address();
        while ($newArray = mysql_fetch_array($result)) {
            
            $address->set_recipients($newArray['recipients']);
            $address->set_street($newArray['street']);
            $address->set_city($newArray['city']);
            $address->set_postcode($newArray['postcode']);
            $address->set_state($newArray['state']);
            $address->set_country($newArray['country']);
            $address->set_customer_id($newArray['customer_id']);
            $address->set_address_type($newArray['address_type']);
        }
        return $address;
    }

    public function load_delivery_address() {
        $link = getConnection();
        $query="select 	customer_id,
                        address_type,
                        recipients,
                        street,
                        city,
                        postcode,
                        state,
                        country
                from	tb_address
                where   customer_id = ".$this->get_customer_id()."
                and     address_type = 'delivery'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);
        $address = new Address();
        while ($newArray = mysql_fetch_array($result)) {

            $address->set_recipients($newArray['recipients']);
            $address->set_street($newArray['street']);
            $address->set_city($newArray['city']);
            $address->set_postcode($newArray['postcode']);
            $address->set_state($newArray['state']);
            $address->set_country($newArray['country']);
            $address->set_customer_id($newArray['customer_id']);
            $address->set_address_type($newArray['address_type']);
        }
        return $address;
    }

        public function loadCustomerReviews() {
        $count = 0;
        $review_list = null;
        $link = getConnection();
        $query="select 	review_id,
                        customer_id,
                        product_id,
                        review_rate,
                        review_text,
                        review_date
                from    tb_review
                where   customer_id = ".$this->get_customer_id()."
                order by review_date desc";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $review = new Review();
            $review->set_review_id($newArray['review_id']);
            $review->set_product_id($newArray['product_id']);
            $review->set_customer_id($newArray['customer_id']);
            $review->set_review_rate($newArray['review_rate']);
            $review->set_review_text($newArray['review_text']);
            $review->set_review_date($newArray['review_date']);

            $review_list[$count] = $review;
            $count++;
        }
        return $review_list;
    }
}
?>
