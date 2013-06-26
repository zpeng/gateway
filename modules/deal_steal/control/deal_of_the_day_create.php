<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\DealOfDay;

$deal_id = secureRequestParameter($_REQUEST['deal_id']);
$dod_date = secureRequestParameter($_REQUEST['dod_date']);

$dod = new DealOfDay();
$dod->setDealId($deal_id);
$dod->setDate($dod_date);
$dod->insert();
$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);

?>
