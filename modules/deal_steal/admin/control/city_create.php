<?
require_once('../../../../includes/bootstrap.php');

$module_code = secureRequestParameter($_REQUEST["module_code"]);
$city_name = secureRequestParameter($_REQUEST["city_name"]);

$city = new City();
$city->setCityName($city_name);
$city->insert();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=city_list"; // target of the redirect
$msg = "New city [" . $city_name . "] has been created";
$url = $url . "&info=" . $msg;

header("Location: " . $url);

?>
