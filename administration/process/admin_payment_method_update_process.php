<?php

require_once('../../included/class_loader.php') ;
require_once('../../included/common_functions.php');

$url = "../index.php?view=admin_payment_method_update"; // target of the redirect


$paymentMethod_id = secureRequestParameter($_REQUEST["payment_method_id"]);
$payment_method_name = secureRequestParameter($_REQUEST["payment_method_name"]);
$payment_method_include_path = secureRequestParameter($_REQUEST["payment_method_include_path"]);
$payment_method_desc = secureRequestParameter($_REQUEST["payment_method_desc"]);

$paymentMethod = new PaymentMethod();
$paymentMethod->load($paymentMethod_id);

$paymentMethod->set_payment_method_name($payment_method_name);
$paymentMethod->set_payment_method_include_path($payment_method_include_path);
$paymentMethod->set_payment_method_desc($payment_method_desc);


$finalDir = "../../images/payment_methods/";
$finalFilename = "";
if ($_FILES['image_uploaded']['tmp_name'] != null) {

    //get the file extension
    $file_info = pathinfo($_FILES['image_uploaded']['name']) ;
    $ext = $file_info['extension'];

    //set up the new file name
    $finalFilename = time().".".$ext;
    $databaseFileName = "images/brands/".$finalFilename;


    //delete the old images if necessary
    $targetFile = $finalDir.$paymentMethod->get_payment_method_logo();
    deleteImageFromServer($targetFile);

    //upload the new logo images
    $result = uploadImage($_FILES['image_uploaded']['tmp_name'],$_FILES['image_uploaded']['name'],$finalDir,$finalFilename);
    $paymentMethod->set_payment_method_logo($finalFilename);
}


$paymentMethod->update();



$url=$url."&payment_method_id=".$paymentMethod->get_payment_method_id();


$msg = "The payment method [".$paymentMethod->get_payment_method_name()."] has been updated.";
$url=$url."&info=".$msg;

header( "Location: ".$url );

?>