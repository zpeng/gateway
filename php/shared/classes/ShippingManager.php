<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ShippingManager
 *
 * @author ziyang
 */
class ShippingManager {
    //put your code here
    public function getShippingList() {
        $shippingList = null;
        $count = 0;
        $link = getConnection();
        $query="    select 	shipping_id,
                        shipping_region_id,
                        shipping_type,
                        shipping_cost,
                        shipping_details
                from    tb_shipping  ";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $shipping = new Shipping();
            $shipping->set_shipping_id($newArray['shipping_id']);
            $shipping->set_shipping_region_id($newArray['shipping_region_id']);
            $shipping->set_shipping_type($newArray['shipping_type']);
            $shipping->set_shipping_cost($newArray['shipping_cost']);
            $shipping->set_shipping_detail($newArray['shipping_details']);

            $shippingList[$count] = $shipping;
            $count++;
        }
        return $shippingList;
    }

    public function getShippingRegionList() {
        $shippingRegionList = null;
        $count = 0;
        $link = getConnection();
        $query="select 	shipping_region_id, shipping_region
                from    tb_shipping_region  ";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $shippingRegion = new ShippingRegion();
            $shippingRegion->set_shipping_region_id($newArray['shipping_region_id']);
            $shippingRegion->set_shipping_region($newArray['shipping_region']);

            $shippingRegionList[$count] = $shippingRegion;
            $count++;
        }
        return $shippingRegionList;
    }
}
?>
