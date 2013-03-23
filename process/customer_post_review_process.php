<?php

require_once('../included/class_loader.php') ;

$customer_id = secureRequestParameter($_REQUEST["customer_id"]);
$product_id = secureRequestParameter($_REQUEST["product_id"]);
$review_rate = secureRequestParameter($_REQUEST["review_rate"]);
$review_text= secureRequestParameter($_REQUEST["review_text"]);

$review = new Review();
$review->set_customer_id($customer_id);
$review->set_product_id($product_id);
$review->set_review_rate($review_rate);
$review->set_review_text($review_text);

$review->insert();

header( "Location: ../index.php?view=product_detail&product_id=".$product_id );

?>
