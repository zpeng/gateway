<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Order;

$order_id = secureRequestParameter($_REQUEST["order_id"]);
$order_status = secureRequestParameter($_REQUEST["order_status"]);

$order = new Order();
$order->setOrderId($order_id);
$order->setOrderStatus($order_status);
$order->updateOrderStatus();

$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);

?>
