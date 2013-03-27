<?
require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_product_list"; // target of the redirect

$product_id = secureRequestParameter($_REQUEST["product_id"]);

$product = new Product();
$product->load($product_id);
$product->undelete();
$producDesc = new ProductDescription();
$producDesc = $product->getProductDescriptionByLanguageID(1);

$msg = "Product [".$producDesc->get_product_name()."] has been put on the shelf.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>
