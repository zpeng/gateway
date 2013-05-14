<?
require_once('../../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Supplier;

$supplier_id = secureRequestParameter($_REQUEST["supplier_id"]);
$module_code = secureRequestParameter($_REQUEST["module_code"]);

$supplier = new Supplier();
$supplier->loadByID($supplier_id);
$supplier->delete();

$url = SERVER_URL."admin/main.php?module_code=".$module_code."&view=supplier_list"; // target of the redirect
$msg = "Supplier [".$supplier->getSupplierName()."] has been deleted";
$url=$url."&info=".$msg;

header( "Location: ".$url );
?>
