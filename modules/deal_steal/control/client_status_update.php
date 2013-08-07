<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Client;

$client_id = secureRequestParameter($_REQUEST["client_id"]);
$is_archived = secureRequestParameter($_REQUEST["is_archived"]);

$client = new Client();
$client->setClientId($client_id);
$client->setClientArchived($is_archived);
$client->updateStatus();

$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);

?>
