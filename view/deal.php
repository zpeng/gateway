<?php
use modules\deal_steal\includes\classes\Deal;
use modules\deal_steal\includes\classes\DealManager;


if (isset($_REQUEST["deal_id"]) && !is_null($_REQUEST["deal_id"])) {
    $deal_id = secureRequestParameter($_REQUEST["deal_id"]);
    $curr_deal = new Deal();
    $dealManager = new DealManager();
    $curr_deal = $dealManager->clientFetchSingleDealFullDetail($deal_id);
    if ($curr_deal == null) {
        redirect_to_404();
    }
} else {
    redirect_to_404();
}
?>
<div class="content twocolumns">
    <div class="rightblock">
        <h2>The fine print</h2>
        <?= $curr_deal->getFinePrint() ?>
    </div>

    <div class="subnav">
        <ul>
            <li><a href="#">Daily</a></li>
            <li><a href="#">Webstore</a></li>
            <li class="last"><a href="#">Voucher Snaps</a></li>
        </ul>
    </div>

    <!-- Deals -->
    <div class="deals">
        <div id="deal_rating" class="stars">
            <div class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32"
                 data-dealid="<?= $deal_id ?>">
            </div>
        </div>

        <h1><?= $curr_deal->getTitle() ?></h1>

        <div class="maindeal">
            <div class="mainimage">
                <div class="mask"></div>

                <div class="leftcontainer">
                    <div class="mainlogo"><img src="images/suppliers/logo/<?= $curr_deal->getSupplierLogo() ?>"
                                               width="86" height="86" border="0"
                                               style="margin-left: 7px;margin-top:7px;margin-bottom: 7px">
                    </div>
                    <div class="mainbought"><?= $curr_deal->getNumBought() ?></div>
                    <div class="mainleft">30 days</div>
                </div>

                <div class="rightcontainer">
                    <div class="maindiscount"><?= $curr_deal->getDiscountRate() ?>%</div>
                    <div class="mainoldprice">&pound;<?= $curr_deal->getOriginalPrice() ?></div>
                    <div class="mainprice">&pound;<?= $curr_deal->getOfferPrice() ?></div>
                </div>

                <img src="images/deals/<?= $curr_deal->getImage() ?>" width="700" height="322" border="0" alt="">
            </div>

            <div class="goto">
                <form action="control/shopping_cart_add.php">
                    <input type="hidden" name="deal_id" value="<?= $curr_deal->getId() ?>">
                    <input class="gotobutton" type="submit" name="goto" value="BUY NOW!">
                </form>
            </div>

            <div class="share">
                <span class='st_facebook_vcount' displayText='Facebook'></span>
                <span class='st_fblike_vcount' displayText='Facebook Like'></span>
                <span class='st_fbrec_vcount' displayText='Facebook Recommend'></span>
                <span class='st_googleplus_vcount' displayText='Google +'></span>
                <span class='st_twitter_vcount' displayText='Tweet'></span>
                <span class='st_email_vcount' displayText='Email'></span>
                <script type="text/javascript">var switchTo5x = true;</script>
                <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
                <script
                    type="text/javascript">stLight.options({publisher: "c5859c6b-c438-4b38-9e2d-9d7e9774c3a3", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
            </div>


        </div>

        <!-- Tabs -->
        <div id="tab-container" class='tab-container'>
            <ul class='etabs'>
                <li class='tab'><a href="#tabs1">About This Deal</a></li>
                <li class='tab'><a href="#tabs2">Terms And Conditions</a></li>

                <? if ($curr_deal->getHasGeoData() == "Y") { ?>
                    <li class='tab'><a href="#tabs3">Location</a></li>
                <? } ?>

            </ul>
            <div class='panel-container'>
                <div id="tabs1">
                    <?= $curr_deal->getDesc() ?>
                </div>

                <div id="tabs2">
                    <?= $curr_deal->getFinePrint() ?>
                </div>

                <? if ($curr_deal->getHasGeoData() == "Y") { ?>
                    <div id="tabs3"><br>
                        <?= $curr_deal->getGoogleMap() ?>
                    </div>
                <? } ?>

            </div>
        </div>


        <div class="clear"></div>

    </div>
</div>

<div class="clear"></div>

<div class="contentbottom">
    <!-- Other deals -->

    <h2>Other Deals:</h2>
    <?
    $latest_deals = $dealManager->clientFetchLatestDealList(4);

    if (sizeof($latest_deals) > 0) {
        foreach ($latest_deals as $latest_deal) {

            ?>
            <div class="deal">
                <h2>
                    <a href="index.php?view=deal&deal_id=<?= $latest_deal->getId() ?>"><?= $latest_deal->getTitle() ?></a>
                </h2>

                <div class="dealimage"><a href="index.php?view=deal&deal_id=<?= $latest_deal->getId() ?>">
                        <img src="images/deals/<?= $latest_deal->getThumbnail() ?>" width="225" height="147" border="0"
                             alt="">
                    </a></div>
                <div class="price">&pound;<?= $latest_deal->getOfferPrice() ?></div>
                <div class="oldpriceholder">
                    <div class="oldprice">&pound;<?= $latest_deal->getOriginalPrice() ?></div>
                </div>
            </div>
        <?
        }
    }
    ?>

</div>
<div class="clear"></div>
<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "rateit-css",)
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "rateit",)
    , $JS_DEPS)?>, function () {

        $('#deal_rating .rateit').rateit('max', 5);
        // only if user has loggged or never voted this deal can vote
        <? if ($_SESSION['client_is_login'] && !$dealManager->checkClientHasVoteDealBefore($_SESSION['client_id'], $deal_id)) { ?>
        $('#deal_rating .rateit').bind('rated reset', function (e) {
            var ri = $(this);

            //if the use pressed reset, it will get value: 0 (to be compatible with the HTML range control), we could check if e.type == 'reset', and then set the value to  null .
            var value = ri.rateit('value');
            var dealID = ri.data('dealid');

            //maybe we want to disable voting?
            ri.rateit('readonly', true);

            $.ajax({
                url: 'control/ajax_service.php', //your server side script
                data: {
                    deal_id: dealID,
                    value: value,
                    client_id: <?=$_SESSION['client_id'] ?>,
                    operation_id: "client_vote_deal" }, //our data
                type: 'POST',
                success: function (data) {
                    console.log("deal vote has been updated");
                },
                error: function (jxhr, msg, err) {
                    console.log(msg);
                }
            });
        });
        <? } else { ?>
        $('#deal_rating .rateit').rateit('value', <?=$curr_deal->getRateAverage()?>);
        $('#deal_rating .rateit').rateit('readonly', true);
        <? }?>
    });
</script>