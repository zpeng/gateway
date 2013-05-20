<div id="supplier_list" class="tile_box_borderless">
    <h3>FIND MORE DEALS FROM...</h3>
    <?
    use modules\deal_steal\includes\classes\SupplierManager;
    $supplierManager = new SupplierManager();
    $supplier_list = $supplierManager->loadAllSuppliers();
    if (sizeof($supplier_list) > 0) {
        foreach ($supplier_list as $supplier) {
            echo "<a href='index.php?supplier_id=".$supplier->getSupplierId()."&view=supplier_deal' >";
            echo "<img border='0' width='60' height='60' class='brand_thumbmail round_corner_box_3px shadow_box'
            alt='" . $supplier->getSupplierName() . "'
            src='" . SERVER_URL . "images/suppliers/logo/" . $supplier->getSupplierLogo() . "' />";
            echo "</a>";
        }
    }
    ?>
    <br class="clear"/>
</div>

