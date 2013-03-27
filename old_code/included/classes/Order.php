<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Order
 *
 * @author Ziyang
 */
class Order {
    //put your code
    private $_order_id;
    private $_order_code;
    private $_order_total_amount ;
    private $_order_create_date;

    private $_order_status_id;

    private $_payment_status_id;
    private $_payment_method_id;
    private $_payment_method;

    private $_shipping_id;
    private $_shipping_method;
    private $_shipping_date;
    private $_shipping_cost;
    private $_shipping_address;


    private $_customer_id;
    private $_customer_email;
    private $_customer;
    private $_customer_comment;
    private $_administrator_comment;

    private $_order_product_list;


    static public function cast(Order $object) {
        return $object;
    }
    public function get_order_id() {
        return $this->_order_id;
    }

    public function set_order_id($_order_id) {
        $this->_order_id = $_order_id;
    }

    public function get_order_code() {
        return $this->_order_code;
    }

    public function set_order_code($_order_code) {
        $this->_order_code = $_order_code;
    }

    public function get_order_total_amount_exclude_shipping() {
        $order_total_amount_exclude_shipping = $this->calculate_total_cost_exclude_shipping();
        return $order_total_amount_exclude_shipping;
    }

    public function get_order_total_amount() {
        $this->set_order_total_amount($this->calculate_total_cost());
        return $this->_order_total_amount;
    }

    public function set_order_total_amount($_order_total_amount) {
        $this->_order_total_amount = $_order_total_amount;
    }

    public function get_order_create_date() {
        return $this->_order_create_date;
    }

    public function set_order_create_date($_order_create_date) {
        $this->_order_create_date = $_order_create_date;
    }

    public function get_order_status_id() {
        return $this->_order_status_id;
    }

    public function set_order_status_id($_order_status_id) {
        $this->_order_status_id = $_order_status_id;
    }

    public function get_payment_status_id() {
        return $this->_payment_status_id;
    }

    public function set_payment_status_id($_payment_status_id) {
        $this->_payment_status_id = $_payment_status_id;
    }

    public function get_payment_method_id() {
        return $this->_payment_method_id;
    }

    public function set_payment_method_id($_payment_method_id) {
        $this->_payment_method_id = $_payment_method_id;
    }

    public function get_payment_method() {
        if ($this->_payment_method == null) {
            $payment_method = new PaymentMethod();
            $payment_method->load($this->_payment_method_id);
            $this->set_payment_method($payment_method);
        }
        return $this->_payment_method;
    }

    public function set_payment_method($_payment_method) {
        $this->_payment_method = $_payment_method;
    }

    public function get_shipping_method() {
        if ($this->_shipping_method == null) {
            $shipping_method = new Shipping();
            $shipping_method->load($this->_shipping_id);
            $this->set_shipping_method($shipping_method);
        }
        return $this->_shipping_method;
    }

    public function set_shipping_method($_shipping_method) {
        $this->_shipping_method = $_shipping_method;
    }



    public function get_shipping_id() {
        return $this->_shipping_id;
    }

    public function set_shipping_id($_shipping_id) {
        $this->_shipping_id = $_shipping_id;
    }

    public function get_shipping_date() {
        return $this->_shipping_date;
    }

    public function set_shipping_date($_shipping_date) {
        $this->_shipping_date = $_shipping_date;
    }

    public function get_shipping_cost() {
        return $this->_shipping_cost;
    }

    public function set_shipping_cost($_shipping_cost) {
        $this->_shipping_cost = $_shipping_cost;
    }

    public function get_shipping_address() {
        return $this->_shipping_address;
    }

    public function set_shipping_address($_shipping_address) {
        $this->_shipping_address = $_shipping_address;
    }

    public function get_customer_id() {
        return $this->_customer_id;
    }

    public function set_customer_id($_customer_id) {
        $this->_customer_id = $_customer_id;
    }

    public function get_customer_email() {
        return $this->_customer_email;
    }

    public function set_customer_email($_customer_email) {
        $this->_customer_email = $_customer_email;
    }

    public function get_customer() {
        if ($this->_customer == null) {
            $customer = new Customer();
            $customer->loadById($this->_customer_id);
            $this->set_customer($customer);
        }
        return $this->_customer;
    }

    public function set_customer($_customer) {
        $this->_customer = $_customer;
    }

    public function get_customer_comment() {
        return $this->_customer_comment;
    }

    public function set_customer_comment($_customer_comment) {
        $this->_customer_comment = $_customer_comment;
    }

    public function get_administrator_comment() {
        return $this->_administrator_comment;
    }

    public function set_administrator_comment($_administrator_comment) {
        $this->_administrator_comment = $_administrator_comment;
    }

    public function get_order_product_list() {
        if ($this->_order_product_list == null) {
            if ($this->get_order_id() != null) {
                $this->set_order_product_list($this->load_order_product_list());
            }
        }
        return $this->_order_product_list;
    }

    public function set_order_product_list($_order_product_list) {
        $this->_order_product_list = $_order_product_list;
    }





    public function getTotalOrderQuantity() {
        $total = 0;
        if( $this->get_order_product_list() != null && (sizeof($this->get_order_product_list() > 0))) {
            foreach($this->get_order_product_list() as $orderproduct) {
                $total = $total + $orderproduct->get_order_quantity();
            }
        }
        return $total;
    }

    public function loadByID($order_id) {
        $link = getConnection();
        $query="select 	order_id,
                        order_code,
                        order_create_date,
                        order_status_id,
                        payment_status_id,
                        payment_method_id,
                        order_total_amount,
                        shipping_id,
                        shipping_cost,
                        shipping_date,
                        customer_id,
                        customer_email,
                        order_shipping_address,
                        order_customer_comment,
                        order_administrator_comment
                from    tb_order
                where   order_id =  ".$order_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_order_id($newArray['order_id']);
            $this->set_order_code($newArray['order_code']);
            $this->set_order_create_date($newArray['order_create_date']);
            $this->set_order_status_id($newArray['order_status_id']);
            $this->set_payment_status_id($newArray['payment_status_id']);
            $this->set_payment_method_id($newArray['payment_method_id']);
            $this->set_order_total_amount($newArray['order_total_amount']);
            $this->set_shipping_id($newArray['shipping_id']);
            $this->set_shipping_cost($newArray['shipping_cost']);
            $this->set_shipping_date($newArray['shipping_date']);
            $this->set_customer_id($newArray['customer_id']);
            $this->set_customer_email($newArray['customer_email']);
            $this->set_shipping_address($newArray['order_shipping_address']);
            $this->set_customer_comment($newArray['order_customer_comment']);
            $this->set_administrator_comment($newArray['order_administrator_comment']);
        }
    }

    public function loadByCode($order_code) {
        $link = getConnection();
        $query="select 	order_id,
                        order_code,
                        order_create_date,
                        order_status_id,
                        payment_status_id,
                        payment_method_id,
                        order_total_amount,
                        shipping_id,
                        shipping_cost,
                        shipping_date,
                        customer_id,
                        customer_email,
                        order_shipping_address,
                        order_customer_comment,
                        order_administrator_comment
                from    tb_order
                where   order_code =  '".$order_code."'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_order_id($newArray['order_id']);
            $this->set_order_code($newArray['order_code']);
            $this->set_order_create_date($newArray['order_create_date']);
            $this->set_order_status_id($newArray['order_status_id']);
            $this->set_payment_status_id($newArray['payment_status_id']);
            $this->set_payment_method_id($newArray['payment_method_id']);
            $this->set_order_total_amount($newArray['order_total_amount']);
            $this->set_shipping_id($newArray['shipping_id']);
            $this->set_shipping_cost($newArray['shipping_cost']);
            $this->set_shipping_date($newArray['shipping_date']);
            $this->set_customer_id($newArray['customer_id']);
            $this->set_customer_email($newArray['customer_email']);
            $this->set_shipping_address($newArray['order_shipping_address']);
            $this->set_customer_comment($newArray['order_customer_comment']);
            $this->set_administrator_comment($newArray['order_administrator_comment']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = "  insert into tb_order
                    (
                    order_code,
                    order_create_date,
                    order_status_id,
                    payment_status_id,
                    payment_method_id,
                    order_total_amount,
                    shipping_id,
                    shipping_cost,
                    shipping_date,
                    customer_id,
                    customer_email,
                    order_shipping_address,
                    order_customer_comment,
                    order_administrator_comment
                    )values (
                             '".$this->get_order_code()."',
                             now(),
                             ".$this->get_order_status_id().",
                             ".$this->get_payment_status_id().",
                             ".$this->get_payment_method_id().",
                             ".$this->get_order_total_amount().",
                             ".$this->get_shipping_id().",
                             ".$this->get_shipping_cost().",
                             '".$this->get_shipping_date()."',
                             ".$this->get_customer_id().",
                             '".$this->get_customer_email()."',
                             '".$this->get_shipping_address()."',
                             '".$this->get_customer_comment()."',
                             '".$this->get_administrator_comment()."')";

        executeUpdateQuery($link , $query);
        $order_id = mysql_insert_id($link);
        $this->set_order_id($order_id);
        closeConnection($link);

        $orderProduct = new OrderProduct();
        if(sizeof($this->get_order_product_list() > 0)) {
            foreach($this->get_order_product_list() as $orderproduct) {
                $orderproduct->set_order_id($order_id);
                $orderproduct->insert();
            }
        }
    }


    public function addOrderProduct(OrderProduct $orderProduct) {
        $id = $orderProduct->get_product_id();
        if (sizeof($this->_order_product_list)>0) {
            $newEntry = array($id =>$orderProduct );
            $this->_order_product_list[$id] = $orderProduct;
        }else {
            $orderProductList[$id] = $orderProduct;
            $this->_order_product_list = $orderProductList;
        }
    }

    public function removeOrderProdcutFromList($productID) {
        if (sizeof($this->_order_product_list)>0) {
            unset($this->_order_product_list[$productID]);
        }
    }

    public function updateOrderProdcutQuantity($productID, $quantity) {
        $orderProduct = new OrderProduct();
        if (sizeof($this->_order_product_list)>0) {
            $orderProduct = $this->_order_product_list[$productID];
            $orderProduct->set_order_quantity($quantity);
        }
    }


    private function load_order_product_list() {
        $orderProductList = null;
        $count = 0;
        $link = getConnection();
        $query="select 	order_product_id,
                        order_id,
                        product_id,
                        order_quantity,
                        selling_price
                from    tb_order_product
                where   order_id = ".$this->get_order_id();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $orderProduct = new OrderProduct();
            $orderProduct->set_order_product_id($newArray['order_product_id']);
            $orderProduct->set_order_id($newArray['order_id']);
            $orderProduct->set_product_id($newArray['product_id']);
            $orderProduct->set_order_quantity($newArray['order_quantity']);
            $orderProduct->set_selling_price($newArray['selling_price']);
            $orderProductList[$count] = $orderProduct;
            $count++;
        }

        return $orderProductList;
    }

    private function calculate_total_cost_exclude_shipping() {
        $cost = 0.00;
        if(sizeof($this->get_order_product_list() > 0)) {
            foreach($this->get_order_product_list() as $orderproduct) {
                $cost = $cost + $orderproduct->getOrderProductTotalCost();
            }
        }
        return $cost;
    }

    private function calculate_total_cost() {
        $cost = 0.00;
        //add shipping
        $cost = $cost + $this->get_shipping_cost();
        if(sizeof($this->get_order_product_list()) > 0) {
            foreach($this->get_order_product_list() as $orderproduct) {
                $cost = $cost + $orderproduct->getOrderProductTotalCost();
            }
        }
        return $cost;
    }


    public function updateOrderAdminComment($admin_comment) {
        $link = getConnection();
        $query = "UPDATE tb_order
                  SET    order_administrator_comment  = '".$admin_comment."'
                  WHERE  order_id         = ".$this->get_order_id();
        executeUpdateQuery($link , $query);
        closeConnection($link);
    }


    public function updateOrderPaymentStatus($payment_status_id) {
        $link = getConnection();
        $query = "UPDATE tb_order
                  SET    payment_status_id  = ".$payment_status_id."
                  WHERE  order_id         = ".$this->get_order_id();
        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function updateOrderStatus($order_status_id) {
        $link = getConnection();
        $query = "UPDATE tb_order
                  SET    order_status_id  = ".$order_status_id."
                  WHERE  order_id         = ".$this->get_order_id();
        executeUpdateQuery($link , $query);
        closeConnection($link);

        // when the order status became completed,
        // then you update the order count for the product
        // then you update the stock level
        if ($order_status_id == '4') {
            $this->uploadOrderProductOrderCount();

            $this->decreaseOrderProductStockLevel();
        }

    }

    private function uploadOrderProductOrderCount() {
        if(sizeof($this->get_order_product_list() > 0)) {
            foreach($this->get_order_product_list() as $orderproduct) {
                $orderproduct->updateProductOrderCount();
            }
        }
    }

    private function decreaseOrderProductStockLevel() {
        if(sizeof($this->get_order_product_list() > 0)) {
            foreach($this->get_order_product_list() as $orderproduct) {
                $product = new Product();
                $product->load($orderproduct->get_product_id());
                $product->decreaseProductStockLevel($orderproduct->get_order_quantity());
            }
        }
    }
}
?>
