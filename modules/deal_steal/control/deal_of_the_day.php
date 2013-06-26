<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\DealManager;
use modules\deal_steal\includes\classes\DealOfDay;

if (!empty($_REQUEST['operation'])) {

    if ($_REQUEST['operation'] == "load") {
        $dealManager = new DealManager();
        echo json_encode($dealManager->getDealOfTheDayDataSource());

    }else if ($_REQUEST['operation'] == "create") {
        $deal_id = secureRequestParameter($_REQUEST['deal_id']);
        $dod_date = secureRequestParameter($_REQUEST['dod_date']);
        $dod = new DealOfDay();
        $dod->setDealId($deal_id);
        $dod->setDate($dod_date);
        $dod->insert();
        $response_array['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($response_array);

    }else if ($_REQUEST['operation'] == "update") {
        $dod_id = secureRequestParameter($_REQUEST['dod_id']);
        $dod_change_day = secureRequestParameter($_REQUEST['dod_change_day']);
        $dod = new DealOfDay();
        $dod->setId($dod_id);
        $dod->update($dod_change_day);
        $response_array['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($response_array);

    }else if ($_REQUEST['operation'] == "delete") {
        $dod_id = secureRequestParameter($_REQUEST['dod_id']);
        $dod = new DealOfDay();
        $dod->delete($dod_id);
        $response_array['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($response_array);
    }


}
?>
