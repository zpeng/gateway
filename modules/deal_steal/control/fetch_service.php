<?
require_once('../../../includes/bootstrap.php');

use modules\deal_steal\includes\classes\ClientManager;
use modules\deal_steal\includes\classes\CityManager;
use modules\deal_steal\includes\classes\SupplierManager;
use modules\deal_steal\includes\classes\DealManager;
use modules\deal_steal\includes\classes\ConciergeManager;
use modules\deal_steal\includes\classes\TemplateManager;
use modules\deal_steal\includes\classes\OrderManager;

if (!empty($_REQUEST['operation_id'])) {
    switch ($_REQUEST['operation_id']) {

        case "fetch_client_table":
            $active = "Y";
            if (isset($_REQUEST["active"])) {
                $active = secureRequestParameter($_REQUEST["active"]);
            }
            $clientManager = new ClientManager();
            $data = $clientManager->getClientTableDataSource($active);
            break;

        case "fetch_city_table":
            $cityManager = new CityManager();
            $data = $cityManager->getCityTableDataSource();
            break;

        case "fetch_city_dropdown_list":
            $cityManager = new CityManager();
            $data = $cityManager->getCityListDataSource();
            break;

        case "fetch_supplier_table":
            $active = "Y";
            if (isset($_REQUEST["active"])) {
                $active = secureRequestParameter($_REQUEST["active"]);
            }
            $supplierManager = new SupplierManager();
            $data = $supplierManager->getSupplierTableDataSource($active);
            break;

        case "fetch_supplier_dropdown_list":
            $active = "Y";
            if (isset($_REQUEST["active"])) {
                $active = secureRequestParameter($_REQUEST["active"]);
            }
            $supplierManager = new SupplierManager();
            $data = $supplierManager->getSupplierDropdownDataSource($active);
            break;

        case "fetch_deal_list":
            $supplier_id = $_REQUEST["supplier_id"];
            $dealManager = new DealManager();
            $data = $dealManager->getDealListDataSource($supplier_id);
            break;

        case "fetch_deal_table":
            $dealManager = new DealManager();
            $data = $dealManager->getDealsTableDataSource();
            break;

        case "fetch_deal_type_dropdown_list":
            $dealManager = new DealManager();
            $data = $dealManager->getDealTypeListDataSource();
            break;

        case "fetch_concierge_table":
            $status = "Pending";
            if (isset($_REQUEST["status"])) {
                $status = secureRequestParameter($_REQUEST["status"]);
            }
            $conciergeManager = new ConciergeManager();
            $data = $conciergeManager->getConciergeTableDataSource($status);
            break;


        case "fetch_order_table":
            $status = "P";
            if (isset($_REQUEST["status"])) {
                $status = secureRequestParameter($_REQUEST["status"]);
            }
            $orderManage = new OrderManager();
            $data = $orderManage->getOrderTableDataSource($status);
            break;


        case "fetch_template_table":
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