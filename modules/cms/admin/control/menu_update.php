<?
require_once('../../../../includes/bootstrap.php');

$module_code = secureRequestParameter($_REQUEST["module_code"]);
$menu_id = secureRequestParameter($_REQUEST["menu_id"]);
$menu_name = secureRequestParameter($_REQUEST["menu_name"]);
$menu_link = secureRequestParameter($_REQUEST["menu_link"]);
$menu_order = secureRequestParameter($_REQUEST["menu_order"]);
$menu_desc = secureRequestParameter($_REQUEST["menu_desc"]);

$menu = new Menu();
$menu->set_menu_id($menu_id);
$menu->set_menu_name($menu_name);
$menu->set_menu_link($menu_link);
$menu->set_menu_order($menu_order);
$menu->set_menu_desc($menu_desc);
$menu->update();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=menu_list"; // target of the redirect
$msg = "The menu item [" . $menu_name . "] has been updated";
$url = $url . "&info=" . $msg;

header("Location: " . $url);

?>
