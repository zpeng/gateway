<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Supplier;

$supplier_id = secureRequestParameter($_REQUEST["supplier_id"]);
$active = secureRequestParameter($_REQUEST["active"]);

$supplier = new Supplier();
$supplier->loadByID($supplier_id);
$supplier->setActive($active);
$supplier->updateStatus();

$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);
?>
