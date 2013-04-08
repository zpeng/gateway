<?
require_once('../../../../includes/bootstrap.php');

$module_code = secureRequestParameter($_REQUEST["module_code"]);
$menu_id = secureRequestParameter($_REQUEST["menu_id"]);

$menu = new Menu();
$menu->load($menu_id);
$menu->delete();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=menu_list"; // target of the redirect
$msg = "The menu item [" . $menu->get_menu_name() . "] has been deleted";
$url = $url . "&info=" . $msg;

header("Location: " . $url);

?>
