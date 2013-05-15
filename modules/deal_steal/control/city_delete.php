<?
require_once('../../../includes/bootstrap.php');

use modules\deal_steal\includes\classes\City;

$city_id = secureRequestParameter($_REQUEST["city_id"]);
$module_code = secureRequestParameter($_REQUEST["module_code"]);

$city = new City();
$city->load($city_id);
$city->delete();

$url = SERVER_URL."admin/main.php?module_code=".$module_code."&view=city_list"; // target of the redirect
$msg = "City [".$city->getCityName()."] has been deleted";
$url=$url."&info=".$msg;

header( "Location: ".$url );
?>
