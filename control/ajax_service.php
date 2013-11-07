<?
require_once('../includes/bootstrap.php');

use modules\deal_steal\includes\classes\DealManager;
use modules\deal_steal\includes\classes\NewsletterSubscribeManager;

if (!empty($_REQUEST['operation_id'])) {
    switch ($_REQUEST['operation_id']) {

        case "client_vote_deal":
            $deal_id = $_REQUEST['deal_id'];
            $client_id = $_REQUEST['client_id'];
            $value = $_REQUEST['value'];
            $dealManager = new DealManager();
            $dealManager->clientUpdateDealRating($client_id, $deal_id, $value);
            break;
        case "client_subscribe":
            $email = $_REQUEST['email'];
            $nsm = new NewsletterSubscribeManager();
            $nsm->subscribe($email);
            break;

        default:
            $response_array['error_code'] = '1';
            $response_array['msg'] = "there is no matching operation id";
            break;
    }

    header('Content-type: application/json');
    echo json_encode($data);
}
?>