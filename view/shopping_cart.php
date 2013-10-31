<?
use modules\deal_steal\includes\classes\Order;

// $client_order is set in the session.php
if (!isset($client_order) && is_null($client_order)) {
    redirect_to_404();
}
?>

<!-- the main content -->
<div id="main">

    <!-- Left Menu -->
    <? include_once("view/left_menu.php"); ?>


    <div class="content">
        <div class="subnav">
            <span class="page_title">Shopping Cart</span>
        </div>

        <table>
            <tr>
                <td>
                    <a href="index.php?view=deal_single&deal_id=<?= $client_order->getDealId() ?>">
                        <img src="images/deals/<?= $client_order->getDealThumbnail() ?>" width="225" height="147"
                             border="0" alt="">
                    </a>
                </td>
                <td>
                    <a href="index.php?view=deal_single&deal_id=<?= $client_order->getDealId() ?>">
                        <?= $client_order->getDealName() ?>
                    </a>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>Price:</td>
                            <td><?= $client_order->getUnitPrice() ?></td>
                            </td></tr>
                        <tr>
                            <td>Quantity:</td>
                            <td><?= $client_order->getQuantity() ?></td>
                            </td></tr>
                        <tr>
                            <td>Total Price:</td>
                            <td><?= $client_order->getTotalPrice() ?></td>
                            </td></tr>
                    </table>

                </td>
            </tr>
        </table>


    </div>

    <div class="clear"></div>
</div>