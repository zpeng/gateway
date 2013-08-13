<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\DealOfDayManager;
use modules\deal_steal\includes\classes\DealOfDay;

if (!empty($_REQUEST['operation_id'])) {
    switch ($_REQUEST['operation_id']) {
        case "load":
            $start = date("Y-m-d", $_REQUEST['start']);
            $end = date("Y-m-d", $_REQUEST['end']);
            $dealOfDayManager = new DealOfDayManager();
            echo json_encode($dealOfDayManager->getDealOfTheDayDataSource($start, $end));
            break;
        case "create":
            $deal_id = secureRequestParameter($_REQUEST['deal_id']);
            $dod_date = secureRequestParameter($_REQUEST['dod_date']);
            $dod = new DealOfDay();
            $dod->setDealId($deal_id);
            $dod->setDate($dod_date);
            $id = $dod->insert();
            $response_array['id'] = $id;
            $response_array['status'] = 'success';
            header('Content-type: application/json');
            echo json_encode($response_array);
            break;
        case "update":
            $dod_id = $_REQUEST['dod_id'];
            $dod_change_day = $_REQUEST['dod_change_day'];
            $dod = new DealOfDay();
            $dod->setId($dod_id);
            $dod->update($dod_change_day);
            $response_array['status'] = 'success';
            header('Content-type: application/json');
            echo json_encode($response_array);
            break;
        case "delete":
            $dod_id = secureRequestParameter($_REQUEST['dod_id']);
            $dod = new DealOfDay();
            $dod->delete($dod_id);
            $response_array['status'] = 'success';
            header('Content-type: application/json');
            echo json_encode($response_array);
            break;
        default:
            break;
    }
}
?>
