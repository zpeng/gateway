<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Supplier;

$supplier_id = secureRequestParameter($_REQUEST["supplier_id"]);
$is_archived = secureRequestParameter($_REQUEST["is_archived"]);

$supplier = new Supplier();
$supplier->loadByID($supplier_id);
$supplier->setSupplierArchived($is_archived);
$supplier->updateStatus();

$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);
?>
