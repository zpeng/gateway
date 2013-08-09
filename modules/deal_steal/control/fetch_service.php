<?
require_once('../../../includes/bootstrap.php');

use modules\deal_steal\includes\classes\ClientManager;

if (!empty($_REQUEST['operation_id'])) {
   switch($_REQUEST['operation_id']){

       case "fetch_client_list":
           $is_archived = "N";
           if(isset($_REQUEST["is_archived"])){
               $is_archived = secureRequestParameter($_REQUEST["is_archived"]);
           }
           $clientManager = new ClientManager();
           header('Content-type: application/json');
           $data = $clientManager->getClientListDataSource($is_archived);
           echo json_encode($data);
           break;

       default:
           $response_array['error_code'] = '1';
           $response_array['msg'] = "there is no matching operation id";
           header('Content-type: application/json');
           echo json_encode($response_array);
           break;
   }
}
?>