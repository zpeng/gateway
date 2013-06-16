<div id="brand_slider" class="tile_box_borderless">
    <h3>WEBSTORE DEALS</h3>
    <div id="CircularContentCarousel-container" class="CircularContentCarousel-container">
        <div class="ca-wrapper">
            <?
            use modules\deal_steal\includes\classes\SupplierManager;
            $supplierManager = new SupplierManager();
            $supplier_list = $supplierManager->loadAllSuppliers();
            if (sizeof($supplier_list) > 0) {
                foreach ($supplier_list as $supplier) {
                    echo "<div class='ca-item'><div class='ca-item-main'>";
                    echo "<div class='ca-icon' style='background:transparent url( ".SERVER_URL . "images/suppliers/logo/" . $supplier->getSupplierLogo().") no-repeat center center;'></div>";
                    echo "<a class='ca-more-link' href='index.php?supplier_id=".$supplier->getSupplierId()."&view=supplier_deal' >Discover More...</a>";
                    echo "</div></div>";
                }

            }
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    // load css
    head.js(<?=outputDependencies(
    array(
    "jquery-CircularContentCarousel-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "jquery-CircularContentCarousel")
    , $JS_DEPS)?>, function () {
        $('#CircularContentCarousel-container').contentcarousel();
    });
</script>