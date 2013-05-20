<div id="supplier_list" class="tile_box_borderless">
    <h3>MORE DEALS AT...</h3>
    <?
    use modules\deal_steal\includes\classes\SupplierManager;
    $supplierManager = new SupplierManager();
    $ds = $supplierManager->getSupplierThumbnailListDataSource(SERVER_URL."images/suppliers/logo/");
    echo createThumbnailList($ds,"brand_thumbmail round_corner_box_3px shadow_box", "60", "60", 0);
    ?>
    <br class="clear"/>
</div>

