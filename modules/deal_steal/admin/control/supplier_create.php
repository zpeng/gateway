<?
require_once('../../../../includes/bootstrap.php');

$module_code = secureRequestParameter($_REQUEST["module_code"]);
$supplier_name = secureRequestParameter($_REQUEST["supplier_name"]);

$supplier = new Supplier();
$supplier->setSupplierName($supplier_name);
$id = $supplier->insert();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=supplier_update&supplier_id=".$id; // target of the redirect
$msg = "New supplier [" . $supplier_name . "] has been created";
$url = $url . "&info=" . $msg;

header("Location: " . $url);

?>
