<?
require_once('../../../includes/bootstrap.php');

use modules\cms\includes\classes\ContentManager;
use modules\cms\includes\classes\MenuManager;

if (!empty($_REQUEST['operation_id'])) {
    switch ($_REQUEST['operation_id']) {

        case "fetch_article_table":
            $contentManager = new ContentManager();
            $data = $contentManager->getContentTableDataSource();
            break;

        case "fetch_menu_table":
            $menu_type_id = "1";
            if (isset($_REQUEST["menu_type_id"])) {
                $menu_type_id = secureRequestParameter($_REQUEST["menu_type_id"]);
            }
            $menuManager = new MenuManager();
            $data = $menuManager->getMenuTableDataSource($menu_type_id);
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