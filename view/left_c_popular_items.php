<div class="left_box">
    <h6>Best Sale</h6>
    <?
    $productManager = new ProductManager();
    $productList = $productManager->getProductMostViewList(3);
    if (sizeof($productList) >0 ) {
        foreach($productList as $product) {
            //$product = new Product();
            echo outputProductAsBlock($product, $s_configManager, $s_language_id);
        }
    }
    ?>

</div>