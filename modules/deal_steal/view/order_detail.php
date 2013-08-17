<script id="html_select_order_status_template" type="text/x-jquery-tmpl">
    <select id="order_status_dropdown" name="order_status_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_option_template" type="text/x-jquery-tmpl">
    <option {{if value === $item.selectedId}} selected="selected"{{/if}} value="${value}">${label}</option>
</script>

<h1 class="content_title">Order Detail</h1>
<div id="notification"></div>
<div id="content">
    <?
    use modules\deal_steal\includes\classes\Order;
    $order_id = secureRequestParameter($_REQUEST["order_id"]);
    $order = new Order();
    $order->loadById($order_id);
    ?>
    <br/>
    <form id="OrderStatusUpdateForm" method='post'>
        <input type="hidden" value="<? echo $order_id ?>" id="order_id" name="order_id"/>
        <table class="general_table">
            <tr>
                <td width="150" align="right"><b>Order ID: </b></td>
                <td><?= $order->getOrderId() ?></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Order Code: </b></td>
                <td><?= $order->getOrderCode() ?></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Client Name: </b></td>
                <td><?= $order->getClientName() ?></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Deal Name: </b></td>
                <td><?= $order->getDealName()?></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Order Quantity: </b></td>
                <td><?= $order->getQuantity()?></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Unit Price: </b></td>
                <td><?= $order->getUnitPrice()?></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Total Price: </b></td>
                <td><?= $order->getTotalPrice()?></td>
            </tr>

            <tr>
                <td width="150" align="right"><b>Payment Method: </b></td>
                <td><?= $order->getPaymentMethod()?></td>
            </tr>

            <tr>
                <td width="150" align="right"><b>Postcode: </b></td>
                <td><?= $order->getDeliveryPostcode()?></td>
            </tr>

            <tr>
                <td width="150" align="right"><b>Address 1: </b></td>
                <td><?= $order->getDeliveryAdd1()?></td>
            </tr>

            <tr>
                <td width="150" align="right"><b>Address 2: </b></td>
                <td><?= $order->getDeliveryAdd2()?></td>
            </tr>

            <tr>
                <td width="150" align="right"><b>County: </b></td>
                <td><?= $order->getDeliveryCounty()?></td>
            </tr>

            <tr>
                <td width="150" align="right"><b>Order Timestamp: </b></td>
                <td><?= $order->getOrderTimestamp()?></td>
            </tr>

            <tr>
                <td width="150" align="right"><b>Order Status: </b></td>
                <td>
                    <div id="order_status_dropdown_div"</div>
                </td>
            </tr>
        </table>
    </form>


</div>

</div>

<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "jquery-ui-css",
    "jquery-form-validate-css",
    "tiny_mce-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "jquery-ui",
    "jquery-tmpl")
    , $JS_DEPS)?>, function () {


        //when page rendering is completed
        $(document).ready(function () {
            var model = {
                data: [
                    { value: "P", label: "Pending" },
                    { value: "D", label: "Delivered" },
                    { value: "C", label: "Cancelled" }
                ],
                selected_value: "<?=$order->getOrderStatus()?>"
            };
            $("#html_select_order_status_template").tmpl(model).appendTo("#order_status_dropdown_div" );
        });


        $("#order_status_dropdown").change(function(e) {
            var order_id = $("#order_id").val();
            var order_status = $("#order_status_dropdown option:selected").val();

            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/order_status_update.php",
                type: "POST",
                data: {order_id: order_id,
                    order_status: order_status
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == "success") {
                        jQuery("div#notification").html("<span class='info'>Order status has been updated successfully!</span>");
                    } else {
                        jQuery("div#notification").html("<span class='error'>Unable to update this Order status. Try again please!</span>");
                    }
                },
                error: function (msg) {
                    ajaxFailMsg(msg);
                }
            });
            return false;

        });

    });

</script>