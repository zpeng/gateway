<?php
use modules\deal_steal\includes\classes\Deal;
use modules\deal_steal\includes\classes\DealManager;


if (isset($_REQUEST["deal_id"]) && !is_null($_REQUEST["deal_id"])) {
    $deal_id = secureRequestParameter($_REQUEST["deal_id"]);
    $deal = new Deal();
    $dealManager = new DealManager();
    $deal = $dealManager->clientFetchSingleDeal($deal_id);
    if ($deal == null) {
        redirect_to_404();
    }
} else {
    redirect_to_404();
}
?>
<div class="content twocolumns">
    <div class="rightblock">
        <h2>The fine print</h2>
        <?= $deal->getFinePrint() ?>
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
        <div class="stars">
            <img src="images/icon_star.png" width="40" height="40" border="0" alt="">
            <img src="images/icon_star.png" width="40" height="40" border="0" alt="">
            <img src="images/icon_star.png" width="40" height="40" border="0" alt="">
        </div>

        <h1><?= $deal->getTitle() ?></h1>

        <div class="maindeal">
            <div class="mainimage">
                <div class="mask"></div>

                <div class="leftcontainer">
                    <div class="mainlogo"><img src="images/brands/logo.png" width="100" height="100" border="0" alt="">
                    </div>
                    <div class="mainbought"><?= $deal->getNumBought() ?></div>
                    <div class="mainleft">30 days</div>
                </div>

                <div class="rightcontainer">
                    <div class="maindiscount"><?= $deal->getDiscountRate() ?>%</div>
                    <div class="mainoldprice">&pound;<?= $deal->getOriginalPrice() ?></div>
                    <div class="mainprice">&pound;<?= $deal->getOfferPrice() ?></div>
                </div>

                <img src="images/deals/<?= $deal->getImage() ?>" width="700" height="322" border="0" alt="">
            </div>

            <div class="goto">
                <form action="control/shopping_cart_add.php">
                    <input type="hidden" name="deal_id" value="<?= $deal->getId() ?>">
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

                <? if ($deal->getHasGeoData() == "Y") { ?>
                    <li class='tab'><a href="#tabs3">Location</a></li>
                <? } ?>

            </ul>
            <div class='panel-container'>
                <div id="tabs1">
                    <?= $deal->getDesc() ?>
                </div>

                <div id="tabs2">
                    <?= $deal->getFinePrint() ?>
                </div>

                <? if ($deal->getHasGeoData() == "Y") { ?>
                    <div id="tabs3"><br>
                        <iframe width="680" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="https://maps.google.co.uk/maps?q=google+map&amp;ie=UTF8&amp;gl=uk&amp;t=m&amp;ll=<?= $deal->getLongitude() ?>,<?= $deal->getLatitude() ?>&amp;spn=0.180164,0.151062&amp;z=11&amp;iwloc=A&amp;output=embed"></iframe>
                        <br/>
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
        foreach ($latest_deals as $deal) {

            ?>
            <div class="deal">
                <h2><a href="index.php?view=deal_single&deal_id=<?= $deal->getId() ?>"><?= $deal->getTitle() ?></a></h2>

                <div class="dealimage"><a href="index.php?view=deal_single&deal_id=<?= $deal->getId() ?>">
                        <img src="images/deals/<?= $deal->getThumbnail() ?>" width="225" height="147" border="0" alt="">
                    </a></div>
                <div class="price">&pound;<?= $deal->getOfferPrice() ?></div>
                <div class="oldpriceholder">
                    <div class="oldprice">&pound;<?= $deal->getOriginalPrice() ?></div>
                </div>
            </div>
        <?
        }
    }
    ?>

</div>
<div class="clear"></div>