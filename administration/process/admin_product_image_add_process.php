<?php

require_once('../../included/class_loader.php') ;
require_once('../../included/common_functions.php');

$url = "../index.php?view=admin_product_update"; // target of the redirect
$tab_id ="Tabs-5";

$product_id = secureRequestParameter($_REQUEST["product_id"]);


$productImage = new ProductImage();

$productImage->set_product_id($product_id);
$productImage->set_product_image_default("N");


$finalDir = "../../images/products/";
$finalFilename = "";
if ($_FILES['image_uploaded']['tmp_name'] != null) {

    //get the file extension
    $file_info = pathinfo($_FILES['image_uploaded']['name']) ;
    $ext = $file_info['extension'];

    //set up the new file name
    $finalFilename = time().".".$ext;
    $databaseFileName = "images/products/".$finalFilename;
    
    //upload the new logo images
    $result = uploadImage($_FILES['image_uploaded']['tmp_name'],$_FILES['image_uploaded']['name'],$finalDir,$finalFilename);
    $productImage->set_product_image_url($finalFilename);
}


$productImage->insert();



$url=$url."&tab_id=".$tab_id;
$url=$url."&product_id=".$product_id;
$msg = "The product gallery has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );
?>

