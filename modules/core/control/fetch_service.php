<?
require_once('../../../includes/bootstrap.php');

use modules\core\includes\classes\ConfigurationManager;

if (!empty($_REQUEST['operation_id'])) {
    switch ($_REQUEST['operation_id']) {

        case "fetch_config_list":
            $module_code = secureRequestParameter($_REQUEST["module_code"]);
            $configurationManager = new ConfigurationManager();
            $data = $configurationManager->getConfigTableDataSource($module_code);
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