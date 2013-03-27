<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of PaymentMethodManager
 *
 * @author ziyang
 */
class PaymentMethodManager {
    //put your code here
    public function loadPaymentMethodList() {
        $count = 0;
        $paymentMethodList;
        $link = getConnection();
        $query="select 	payment_method_id,
                        payment_method_name,
                        payment_method_include_path,
                        payment_method_logo,
                        payment_method_desc
                from    tb_payment_method";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->set_payment_method_id($newArray['payment_method_id']);
            $paymentMethod->set_payment_method_name($newArray['payment_method_name']);
            $paymentMethod->set_payment_method_include_path($newArray['payment_method_include_path']);
            $paymentMethod->set_payment_method_logo($newArray['payment_method_logo']);
            $paymentMethod->set_payment_method_desc($newArray['payment_method_desc']);

            $paymentMethodList[$count] = $paymentMethod;
            $count++;
        }
        return $paymentMethodList;
    }

}
?>
