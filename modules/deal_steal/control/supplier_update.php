<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Supplier;
use includes\shared\classes\FileUploader;

$module_code = secureRequestParameter($_REQUEST["module_code"]);
$supplier_id = secureRequestParameter($_REQUEST["supplier_id"]);
$supplier_name = secureRequestParameter($_REQUEST["supplier_name"]);
$supplier_url = secureRequestParameter($_REQUEST["supplier_url"]);
$supplier_address = secureRequestParameter($_REQUEST["supplier_address"]);
$supplier_email = secureRequestParameter($_REQUEST["supplier_email"]);
$supplier_tel = secureRequestParameter($_REQUEST["supplier_tel"]);
$supplier_desc = secureRequestParameter($_REQUEST["supplier_desc"]);

$supplier = new Supplier();
$supplier->loadByID($supplier_id);
$supplier->setSupplierId($supplier_id);
$supplier->setSupplierName($supplier_name);
$supplier->setSupplierUrl($supplier_url);
$supplier->setSupplierAddress($supplier_address);
$supplier->setSupplierEmail($supplier_email);
$supplier->setSupplierTel($supplier_tel);
$supplier->setSupplierDesc($supplier_desc);

if (!empty($_FILES['logo_image_uploaded']) && $_FILES['logo_image_uploaded']['size'] > 0) {
    $new_name = $supplier_id . time();
    $destination_path = BASE_PATH . "images/suppliers/logo/";

    if ($supplier->getSupplierLogo() != "default.jpg") {
        unlink($destination_path . $supplier->getSupplierLogo()); // remove original image if necessary
    }
    $imgUploader = new FileUploader($_FILES['logo_image_uploaded'], $destination_path, $new_name, array("jpg", "png", "jpeg", "gif"), "2097152");
    $result = $imgUploader->upload();

    $logo_file_name = $result["file_name"];
    $supplier->setSupplierLogo($logo_file_name);
}


$supplier->update();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=supplier_update&supplier_id=" . $supplier_id; // target of the redirect
$msg = "Supplier [" . $supplier_name . "] has been updated!";
$url = $url . "&info=" . $msg;

header("Location: " . $url);
?>
