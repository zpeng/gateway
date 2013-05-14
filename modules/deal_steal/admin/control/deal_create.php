<?
require_once('../../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Deal;

$module_code = secureRequestParameter($_REQUEST["module_code"]);

$deal_title = secureRequestParameter($_REQUEST["deal_title"]);
$deal_city = secureRequestParameter($_REQUEST["deal_city"]);
$deal_supplier = secureRequestParameter($_REQUEST["deal_supplier"]);
$deal_type = secureRequestParameter($_REQUEST["deal_type"]);
$available_quantity = secureRequestParameter($_REQUEST["available_quantity"]);
$original_price = secureRequestParameter($_REQUEST["original_price"]);
$offer_price = secureRequestParameter($_REQUEST["offer_price"]);
$online_date = secureRequestParameter($_REQUEST["online_date"]);
$offline_date = secureRequestParameter($_REQUEST["offline_date"]);

$deal = new Deal();
$deal->setTitle($deal_title);
$deal->setCityId($deal_city);
$deal->setCategoryId(1);
$deal->setSupplierId($deal_supplier);
$deal->setType($deal_type);
$deal->setQuantity($available_quantity);
$deal->setOriginalQuantity($available_quantity);
$deal->setOriginalPrice($original_price);
$deal->setOfferPrice($offer_price);
$deal->setOnlineDate($online_date);
$deal->setOfflineDate($offline_date);
$id = $deal->insert();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=deal_update&deal_id=".$id; // target of the redirect
$msg = "New Deal [" . $deal_title . "] has been created";
$url = $url . "&info=" . $msg;

header("Location: " . $url);

?>
