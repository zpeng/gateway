<?php

require_once('../../included/class_loader.php');
require_once('../../included/common_functions.php');

$url = "../index.php?view=admin_brand_update"; // target of the redirect


$brand_id = secureRequestParameter($_REQUEST["brand_id"]);
$brand_name = secureRequestParameter($_REQUEST["brand_name"]);
$brand_url = secureRequestParameter($_REQUEST["brand_url"]);
$brand_desc = $_REQUEST["brand_desc"];

$brand = new Manufacturer();
$brand->load($brand_id);

$brand->set_manufacturer_name($brand_name);
$brand->set_manufacturer_url($brand_url);
$brand->set_manufacturer_desc($brand_desc);


$finalDir = "../../images/brands/";
$finalFilename = "";
if ($_FILES['image_uploaded']['tmp_name'] != null) {

    //get the file extension
    $file_info = pathinfo($_FILES['image_uploaded']['name']) ;
    $ext = $file_info['extension'];

    //set up the new file name
    $finalFilename = time().".".$ext;
    $databaseFileName = "images/brands/".$finalFilename;


    //delete the old images if necessary
    $targetFile = $finalDir.$brand->get_manufacturer_image();
    deleteImageFromServer($targetFile);

    //upload the new logo images
    $result = uploadImage($_FILES['image_uploaded']['tmp_name'],$_FILES['image_uploaded']['name'],$finalDir,$finalFilename);
    $brand->set_manufacturer_image($finalFilename);
}


$brand->update();



$url=$url."&brand_id=".$brand->get_manufacturer_id();


$msg = "The brand [".$brand_name."] has been updated.";
$url=$url."&info=".$msg;

header( "Location: ".$url );

?>