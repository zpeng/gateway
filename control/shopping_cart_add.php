<?php
include_once '../session.php';

if (!$_SESSION['client_is_login']) {
    header("Location: index.php?view=login");
}


use modules\deal_steal\includes\classes\Deal;
use modules\deal_steal\includes\classes\Order;

$deal_id = secureRequestParameter($_REQUEST['deal_id']);

$client_order = new Order();

$deal = new Deal();
$deal->loadById($deal_id);

$quantity = 1;
$client_order->setDealId($deal_id);
$client_order->setDealName($deal->getTitle());
$client_order->setDealThumbnail($deal->getThumbnail());
$client_order->setUnitPrice($deal->getOfferPrice());
$client_order->setQuantity($quantity);

unset ($_SESSION['client_order']);
$_SESSION['client_order'] = serialize($client_order);

header( "Location: ../index.php?view=shopping_cart");


?>
