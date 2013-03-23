<div class="content">
    <h5>Onsale</h5>
    <br/>
    <center>
        <?
        $productManager = new ProductManager();
        $productList = $productManager->getProductOnsaleList();
        if (sizeof($productList) >0 ) {
            foreach($productList as $product) {
                //$product = new Product();
                echo outputProductAsBlock($product, $s_configManager, $s_language_id);
            }
        }
        ?>

    </center>
</div>
