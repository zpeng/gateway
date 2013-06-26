<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\DealOfDay;

$dod_id = secureRequestParameter($_REQUEST['dod_id']);
$dod_change_day = secureRequestParameter($_REQUEST['dod_change_day']);

$dod = new DealOfDay();
$dod->setId($dod_id);
$dod->update($dod_change_day);
$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);

?>
