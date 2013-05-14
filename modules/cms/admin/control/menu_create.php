<?
require_once('../../../../includes/bootstrap.php');
use modules\cms\includes\classes\Menu;


$module_code = secureRequestParameter($_REQUEST["module_code"]);

$menu_name = secureRequestParameter($_REQUEST["menu_name"]);
$menu_order = secureRequestParameter($_REQUEST["menu_order"]);

$menu_type_id = secureRequestParameter($_REQUEST["menu_type_selector"]);
$menu_parent_id = secureRequestParameter($_REQUEST["menu_level_selector"]);

$link_type_id = secureRequestParameter($_REQUEST["link_type_selector"]);

if ($link_type_id == 0) {
    $menu_link = secureRequestParameter($_REQUEST["menu_link"]);
} else if ($link_type_id == 1) {
    $content_id = secureRequestParameter($_REQUEST["content_list_selector"]);
    $menu_link = "index.php?view=cms&article_id=" . $content_id;
}

$menu = new Menu();
$menu->set_menu_name($menu_name);
$menu->set_menu_order($menu_order);
$menu->set_menu_type_id($menu_type_id);
$menu->set_menu_parent_id($menu_parent_id);
$menu->set_menu_link($menu_link);

$menu->insert();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=menu_list"; // target of the redirect
$msg = "The menu item [" . $menu_name . "] has been created";
$url = $url . "&info=" . $msg;

header("Location: " . $url);


?>
