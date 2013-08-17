<?php
namespace modules\deal_steal\includes\classes;


class OrderManager
{
    private function loadOrdersByStatus($status = "P")
    {
        $order_list = [];
        $link = getConnection();
        $query = " SELECT
                      order_id,
                      order_code,
                      ds_client.client_id,
                      CONCAT(ds_client.client_firstname, ' ' , ds_client.client_surname) AS client_name,
                      ds_order.deal_id,
                      CONCAT(ds_supplier.supplier_name, ' - ', ds_deal.deal_title) AS deal_title,
                      unit_price,
                      total_price,
                      ds_order.quantity,
                      payment_method,
                      del_postcode,
                      del_add_1,
                      del_add_2,
                      del_county,
                      order_timestamp,
                      order_status
                    FROM ds_order, ds_client, ds_deal, ds_supplier
                    WHERE ds_client.client_id = ds_order.client_id
                    AND ds_deal.deal_id = ds_order.deal_id
                    AND ds_supplier.supplier_id = ds_deal.supplier_id
                    AND order_status  =  '" . $status . "'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $order = new Order();
            $order->setOrderId($newArray['order_id']);
            $order->setOrderCode($newArray['order_code']);
            $order->setClientId($newArray['client_id']);
            $order->setClientName($newArray['client_name']);
            $order->setDealId($newArray['deal_id']);
            $order->setDealName($newArray['deal_title']);
            $order->setUnitPrice($newArray['unit_price']);
            $order->setTotalPrice($newArray['total_price']);
            $order->setQuantity($newArray['quantity']);
            $order->setPaymentMethod($newArray['payment_method']);
            $order->setDeliveryPostcode($newArray['del_postcode']);
            $order->setDeliveryAdd1($newArray['del_add_1']);
            $order->setDeliveryAdd2($newArray['del_add_2']);
            $order->setDeliveryCounty($newArray['del_county']);
            $order->setOrderTimestamp($newArray['order_timestamp']);
            $order->setOrderStatus($newArray['order_status']);
            array_push($order_list, $order);
        }
        return $order_list;
    }

    public function getOrderTableDataSource($status = 'P')
    {
        $order_list = $this->loadOrdersByStatus($status);
        $dataSource = array();
        if (sizeof($order_list) > 0) {
            foreach ($order_list as $order) {
                array_push($dataSource, array(
                    "id" => $order->getOrderId(),
                    "order_code" => $order->getOrderCode(),
                    "client_name" => $order->getClientName(),
                    "deal_name" => $order->getDealName(),
                    "quantity" => $order->getQuantity(),
                    "total_price" => $order->getTotalPrice(),
                    "order_timestamp" => $order->getOrderTimestamp(),
                    "order_status" => $order->getOrderStatus(),
                    "action" => ""
                ));
            }
        }
        return $dataSource;
    }
}


?>