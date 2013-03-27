<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title">Administration Control Panel</span>
    </div>
</fieldset>
<?
include_once 'admin_msg_view.php';
?>
<?
require_once("../included/class_loader.php");
require_once("../included/html_functions.php");
?>
<fieldset class="content_fieldset">
    <br/>
    <dl class="accordion" id="slider">
        <dt>Incoming Orders</dt>
        <dd>
            <br/><b>For the past one week:</b>
<?
$orderManager = new OrderManager();
$orderList = $orderManager->loadOrderListForPeriod(7);
echo sizeof($orderList);
?>
            <br/>
<?
if (sizeof($orderList) > 0) {
    echo "<br/><table border='0'cellpadding='0' cellspacing='0' class='tinytable' >
                <thead>
                <tr>
                    <th><h3>&nbsp;Order Code</h3></th>
                    <th><h3>Create Date</h3></th>
                    <th><h3>Customer</h3></th>
                    <th><h3>Amount</h3></th>
                    <th><h3>Order Status</h3></th>
                    <th><h3>Payment Status</h3></th>
                </tr></thead>";

    $orderStatus = new OrderStatus();
    $paymentStatus = new PaymentStatus();
    foreach ($orderList as $order) {
        echo "  <tr>
                                <td><a href='index.php?view=admin_order_update&order_id=" . $order->get_order_id() . "'>" . $order->get_order_code() . "</a></td>
                                <td>" . $order->get_order_create_date() . "</td>
                                <td>" . $order->get_customer_email() . "</td>
                                <td>" . $order->get_order_total_amount(). "</td>
                                <td>" . $orderStatus->getOrderStatusById($order->get_order_status_id()) . "</td>
                                <td>" . $paymentStatus->getpaymentStatusById($order->get_payment_status_id()) . "</td>
                            </tr> ";
    }

    echo "</table>";
}
?>
            <br/><br/>
        </dd>


        <dt>Inventory Control</dt>
        <dd>
            <br/><b>The product stock warning level:</b>
<?
$producrManager = new ProductManager();
$productList = $producrManager->getProductListUnderStockLevel($s_configManager->getValueByKey("stock_level_warning"));
echo $s_configManager->getValueByKey("stock_level_warning");
?>
            <br/>
<?
if (sizeof($productList) > 0) {
    echo "<br/><table border='0'cellpadding='0' cellspacing='0' class='tinytable' >
                <thead>
                <tr>
                    <th><h3>&nbsp;ID</h3></th>
                    <th><h3>Product Name</h3></th>
                    <th><h3>SKU</h3></th>
                    <th><h3>Brand/Manufacturer</h3></th>
                    <th><h3>Price</h3></th>
                    <th><h3>Onsale</h3></th>
                    <th><h3>Stock Level</h3></th>
                    <th><h3>On/off the Shelf</h3></th>
                </tr></thead>";

    foreach ($productList as $product) {
        $brand = new Manufacturer();
        $brand = $product->get_manufacturer();
        echo "  <tr>
                                <td><a href='index.php?view=admin_product_update&product_id=" . $product->get_product_id() . "' >" . $product->get_product_id() . "</a></td>
                                <td>" . $product->getProductDescriptionByLanguageID(1)->get_product_name() . "</td>
                                <td>" . $product->get_product_sku() . "</td>
                                <td>" . $brand->get_manufacturer_name() . "</td>
                                <td>" . $product->get_product_price() . "</td>
                                <td>" . $product->get_product_onsale_as_icon() . "</td>
                                <td>" . $product->get_product_stock_level() . "</td>
                                <td>" . $product->get_product_archived_as_icon() . "</td>
                            </tr> ";
    }

    echo "</table>";
}
?>
            <br/><br/>
        </dd>


        <dt>Newly Customers</dt>
        <dd>
            <br/><b>For the past one week:</b>
<?
$customerManager = new CustomerManager();
$customerList = $customerManager->getCustomerListRegisterForPeriod(7);
echo sizeof($customerList);
?>
            <br/>
<?
if (sizeof($customerList) > 0) {
    echo "<br/><table border='0'cellpadding='0' cellspacing='0' class='tinytable' >
                <thead>
                <tr>
                    <th><h3>&nbsp;ID</h3></th>
                    <th><h3>Email</h3></th>
                    <th><h3>Full Name</h3></th>
                    <th><h3>Tel</h3></th>
                    <th><h3>Mobile</h3></th>
                    <th><h3>Newsletter Subscribe</h3></th>
                    <th><h3>Register Date</h3></th>
                </tr></thead>";

    foreach ($customerList as $customer) {
        echo "  <tr>
                            <td>" . $customer->get_customer_id() . "</td>
                            <td>" . $customer->get_email() . "</td>
                            <td>" . $customer->get_full_name() . "</td>
                            <td>" . $customer->get_telephone() . "</td>
                            <td>" . $customer->get_mobile() . "</td>
                            <td>" . $customer->get_newsletter_as_icon() . "</td>
                            <td>" . $customer->get_register_date() . "</td>
                            </tr> ";
    }

    echo "</table>";
}
?>
            <br/><br/>
        </dd>

    </dl>
    <br/>
</fieldset>

<script type="text/javascript">
    var slider=new accordion.slider("slider");
    slider.init("slider",0,"open");
</script>
