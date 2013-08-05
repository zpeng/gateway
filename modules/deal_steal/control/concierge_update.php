<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Concierge;

$con_id = secureRequestParameter($_REQUEST["con_id"]);
$status = secureRequestParameter($_REQUEST["status"]);

$concierge = new Concierge();
$concierge->setId($con_id);
$concierge->setStatus($status);
$concierge->updateStatus();

$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);

?>
