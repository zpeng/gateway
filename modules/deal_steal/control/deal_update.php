<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Deal;
use modules\deal_steal\includes\classes\TagManager;
use includes\shared\classes\FileUploader;


$deal = new Deal();

if (!empty($_REQUEST['operation'])) {
    if ($_REQUEST['operation'] == "deal_detail_update") {
        $deal->setId($_REQUEST["deal_id"]);
        $deal->setTitle($_REQUEST["deal_title"]);
        $deal->setCityId($_REQUEST["deal_city"]);
        $deal->setSupplierId($_REQUEST["deal_supplier"]);
        $deal->setType($_REQUEST["deal_type"]);
        $deal->setQuantity($_REQUEST["available_quantity"]);
        $deal->setOriginalQuantity($_REQUEST["original_quantity"]);
        $deal->setOriginalPrice($_REQUEST["original_price"]);
        $deal->setOfferPrice($_REQUEST["offer_price"]);
        $deal->setOnlineDate($_REQUEST["online_date"]);
        $deal->setOfflineDate($_REQUEST["offline_date"]);
        $deal->setHasGeoData($_REQUEST["has_geo_data"]);
        $deal->setLatitude($_REQUEST["latitude"]);
        $deal->setLongitude($_REQUEST["longitude"]);
        $deal->update();

        $response_array['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($response_array);
    } else if ($_REQUEST['operation'] == "deal_category_update") {
        $deal->setId($_REQUEST["deal_id"]);
        $deal->setCategoryId($_REQUEST["category_id"]);
        $deal->updateCategory();

        $response_array['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($response_array);
    } else if ($_REQUEST['operation'] == "deal_tag_update") {
        $tagManager = new TagManager();
        $deal_tag_id_list = array();
        if (!empty($_REQUEST["deal_tag_id_list"])) {
            $deal_tag_id_list = $_REQUEST["deal_tag_id_list"];
        }
        $tagManager->updateDealTags($_REQUEST["deal_id"], $deal_tag_id_list);

        $response_array['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($response_array);
    } else if ($_REQUEST['operation'] == "deal_desc_update") {
        $deal->setId($_REQUEST["deal_id"]);
        $deal->setDesc($_REQUEST["deal_desc"]);
        $deal->updateDescription();

        $response_array['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($response_array);
    } else if ($_REQUEST['operation'] == "fine_print_update") {
        $deal->setId($_REQUEST["deal_id"]);
        $deal->setFinePrint($_REQUEST["fine_print"]);
        $deal->updateFinePrint();

        $response_array['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($response_array);
    } else if ($_REQUEST['operation'] == "voucher_template_update") {
        $deal->setId($_REQUEST["deal_id"]);
        $deal->setVoucher($_REQUEST["voucher_template"]);
        $deal->updateVoucherTemplate();

        $response_array['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($response_array);
    } else if ($_REQUEST['operation'] == "update_deal_image") {
        $deal->setId($_REQUEST["deal_id"]);
        $module_code = secureRequestParameter($_REQUEST["module_code"]);

        if ($_FILES['deal_image_uploaded'] != null) {
            $new_name = $deal->getId() . time();
            $deal->loadById($_REQUEST["deal_id"]);
            $destination_path = BASE_PATH . "images/deals/";

            $imgUploader = new FileUploader($_FILES['deal_image_uploaded'], $destination_path, $new_name, array("jpg", "png", "jpeg", "gif"), "2097152");
            if ($deal->getImage() != "default.jpg") {
                $imgUploader->deleteFileFromServer($destination_path . $deal->getImage()); // remove original image if necessary
            }

            $result = $imgUploader->upload();

            $image_name = $result["file_name"];
            $deal->setImage($image_name);
            $deal->updateImage();

            $url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=deal_update&deal_id=" . $deal->getId(); // target of the redirect
            $msg = "Deal image has been updated!";
            $url = $url . "&info=" . $msg;
            header("Location: " . $url);
        }
    } else if ($_REQUEST['operation'] == "update_deal_thumbnail") {
        $deal->setId($_REQUEST["deal_id"]);
        $module_code = secureRequestParameter($_REQUEST["module_code"]);

        if ($_FILES['deal_thumbnail_uploaded'] != null) {
            $new_name = $deal->getId() . time();
            $deal->loadById($_REQUEST["deal_id"]);
            $destination_path = BASE_PATH . "images/deals/";

            $imgUploader = new FileUploader($_FILES['deal_thumbnail_uploaded'], $destination_path, $new_name, array("jpg", "png", "jpeg", "gif"), "2097152");
            if ($deal->getThumbnail() != "default_t.jpg") {
                $imgUploader->deleteFileFromServer($destination_path . $deal->getThumbnail()); // remove original image if necessary
            }

            $result = $imgUploader->upload();

            $image_name = $result["file_name"];
            $deal->setThumbnail($image_name);
            $deal->updateThumbnail();

            $url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=deal_update&deal_id=" . $deal->getId(); // target of the redirect
            $msg = "Deal thumbnail has been updated!";
            $url = $url . "&info=" . $msg;
            header("Location: " . $url);
        }
    }
} else {
    $response_array['status'] = 'failed';
    header('Content-type: application/json');
    echo json_encode($response_array);
}
?>
