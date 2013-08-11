<?
require_once('../../../includes/bootstrap.php');

use modules\deal_steal\includes\classes\ClientManager;
use modules\deal_steal\includes\classes\CityManager;
use modules\deal_steal\includes\classes\SupplierManager;
use modules\deal_steal\includes\classes\DealManager;
use modules\deal_steal\includes\classes\ConciergeManager;
use modules\deal_steal\includes\classes\TemplateManager;

if (!empty($_REQUEST['operation_id'])) {
    switch ($_REQUEST['operation_id']) {

        case "fetch_client_list":
            $is_archived = "N";
            if (isset($_REQUEST["is_archived"])) {
                $is_archived = secureRequestParameter($_REQUEST["is_archived"]);
            }
            $clientManager = new ClientManager();
            $data = $clientManager->getClientTableDataSource($is_archived);
            break;

        case "fetch_city_list":
            $cityManager = new CityManager();
            $data = $cityManager->getCityTableDataSource();
            break;

        case "fetch_supplier_list":
            $supplierManager = new SupplierManager();
            $data = $supplierManager->getSupplierTableDataSource();
            break;

        case "fetch_deal_list":
            $dealManager = new DealManager();
            $data = $dealManager->getDealsTableDataSource();
            break;

        case "fetch_concierge_list":
            $status = "Pending";
            if (isset($_REQUEST["status"])) {
                $status = secureRequestParameter($_REQUEST["status"]);
            }
            $conciergeManager = new ConciergeManager();
            $data = $conciergeManager->getConciergeTableDataSource($status);
            break;

        case "fetch_template_list":
            $templateManager = new TemplateManager();
            $data = $templateManager->getTemplateTableDataSource();
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