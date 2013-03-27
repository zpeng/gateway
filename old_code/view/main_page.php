<?
// show banner
if ($s_configManager->getValueByKey("show_banner") == "Y") {
    include_once 'slider/slider.php';
}
?>
<div class="content">
    <h5>Our Products</h5>
    <br/>
        <?
        $productManager = new ProductManager();
        $productList = $productManager->getProductNewArrivalList($s_configManager->getValueByKey("num_item_on_index_page"));
        if (sizeof($productList) >0 ) {
            foreach($productList as $product) {
                echo outputProductAsBlock($product, $s_configManager, $s_language_id);
            }
        }
        ?>
    <br/>
</div>

