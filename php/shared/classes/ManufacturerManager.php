<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ManufacturerManager
 *
 * @author ziyang
 */
class ManufacturerManager {
    //put your code here
    public function getBrandList() {
        $brandList;
        $count =  0;
        $link = getConnection();

        $query="select 	manufacturer_id,
                        manufacturer_name,
                        manufacturer_desc,
                        manufacturer_image,
                        manufacturer_url,
                        manufacturer_archived
                from    tb_manufacturer
                where   manufacturer_archived = 'N'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $manufacturer = new Manufacturer();
            $manufacturer->set_manufacturer_id($newArray['manufacturer_id']);
            $manufacturer->set_manufacturer_name($newArray['manufacturer_name']);
            $manufacturer->set_manufacturer_desc($newArray['manufacturer_desc']);
            $manufacturer->set_manufacturer_image($newArray['manufacturer_image']);
            $manufacturer->set_manufacturer_url($newArray['manufacturer_url']);
            $manufacturer->set_manufacturer_archived($newArray['manufacturer_archived']);
            $brandList[$count] =$manufacturer;
            $count ++;
        }
        return $brandList;
    }

}
?>
