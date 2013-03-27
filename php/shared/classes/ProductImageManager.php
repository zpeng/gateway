<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ProductImageManager
 *
 * @author ziyang
 */
class ProductImageManager {
    //put your code here
    private $_product_id;
    private $_image_path;
    private $_product_image_list;
    private $_default_product_image;

    public function get_product_id() {
        return $this->_product_id;
    }

    public function set_product_id($_product_id) {
        $this->_product_id = $_product_id;
    }

    public function get_image_path() {
        return $this->_image_path;
    }

    public function set_image_path($_image_path) {
        $this->_image_path = $_image_path;
    }

    public function get_product_image_list() {
        if ($this->_product_image_list == null) {
            $this->load_product_image_list();
        }
        return $this->_product_image_list;
    }

    public function set_product_image_list($_product_image_list) {
        $this->_product_image_list = $_product_image_list;
    }

    public function get_default_product_image() {
        //first load product image list
        $this->load_product_image_list();
        
        if ($this->_default_product_image == null) {
            // if there is no default image defined, then select the first images from the list as default
            $imageList = $this->get_product_image_list();
            $this->set_default_product_image($imageList[0]);
        }
        return $this->_default_product_image;
    }

    public function set_default_product_image($_default_product_image) {
        $this->_default_product_image = $_default_product_image;
    }

    private function load_product_image_list() {
        $productImageList;
        $count =  0;
        $link = getConnection();

        $query="select 	product_image_id,
                        product_id,
                        product_image_url,
                        product_image_default
                from	tb_product_image
                where   product_id = ".$this->get_product_id();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $productImage = new ProductImage();
            $productImage->set_product_image_id($newArray['product_image_id']);
            $productImage->set_product_id($newArray['product_id']);
            $productImage->set_product_image_url($newArray['product_image_url']);
            $productImage->set_product_image_default($newArray['product_image_default']);
            $productImage->set_product_image_path($this->get_image_path());

            if ($productImage->get_product_image_default() == "Y") {
                // find default image
                $this->set_default_product_image($productImage);
            }
            $productImageList[$count] =$productImage;
            $count ++;
        }
        $this->set_product_image_list($productImageList);
    }

    public function updateImageListDefaultSetting($new_default_product_image_id) {
        if (sizeof($this->get_product_image_list()) > 0 ) {
            foreach($this->get_product_image_list() as $_product_image) {
                if ($_product_image->get_product_image_id() == $new_default_product_image_id) {
                    $_product_image->updateDefaultImage("Y");
                }else {
                    $_product_image->updateDefaultImage("N");
                }
            }
        }
        return null;
    }

}
?>
