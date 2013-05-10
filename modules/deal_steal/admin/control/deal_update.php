<?
require_once('../../../../includes/bootstrap.php');

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
        $deal->setDesc($_REQUEST["deal_desc"]);

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
    }
} else {
    $response_array['status'] = 'failed';
    header('Content-type: application/json');
    echo json_encode($response_array);
}
?>
