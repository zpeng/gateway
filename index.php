<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<?php
// this is always required
require_once('includes/bootstrap.php');
use modules\core\includes\classes\ConfigurationManager;
$configManager = new ConfigurationManager();
$configManager->loadAllConfig();
?>
<html>
<head>

<? echo  outputHTMLStartFrontend($JS_FRONTEND, array("css/style.css"), $configManager) ?>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">var switchTo5x = true;</script>
<script type="text/javascript">
    stLight.options({publisher: "ur-822fd650-6b38-3317-b453-e3ff450cae3a", doNotHash: false, doNotCopy: false, hashAddressBar: false});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tab-container').easytabs();
    });
</script>

</head><body class='dealdetails'>
<div id="wrapper">

<!-- Top Header -->
<? include_once("view/top_header.php"); ?>

<!-- Top Menu -->
<? include_once("view/top_menu.php"); ?>

<!-- the main content -->
<div id="main">

    <!-- Left Menu -->
    <? include_once("view/left_menu.php"); ?>


    <div class="content twocolumns">
        <div class="rightblock">
            <h2>The fine print:</h2>
            <ul>
                <li>Ticket valid until Nov 30, 2013.</li>
                <li>Ticket collection period: Oct 17, 2013 � Nov 29, 2013.</li>
                <li>No bookings required. First-come, first-served basis.</li>
                <li>Valid for collection from Mon � Sat: 10am � 7pm (not including Sundays, eve of public holidays, and
                    public holidays).
                </li>

            </ul>

            <h2>Things to do in Barcelona:</h2>

            <p>
                City breaks to Barcelona are ideal for any budget, expensive restaurants rub shoulders with street cafes
                and fast food joints, designer boutiques share streets with budget stores and inexpensive holiday flats
                are found next door to luxurious hotels, so no matter what your age, tastes or spending preferences,
                this city caters to all.
            </p>


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


            <div class="stars"><img src="images/icon_star.png" width="40" height="40" border="0" alt=""><img
                    src="images/icon_star.png" width="40" height="40" border="0" alt=""><img src="images/icon_star.png"
                                                                                             width="40" height="40"
                                                                                             border="0" alt=""></div>

            <h1>Trip to Barcelona</h1>

            <div class="maindeal">
                <div class="mainimage">
                    <div class="mask"></div>

                    <div class="leftcontainer">
                        <div class="mainlogo"><img src="images/brands/logo.png" width="100" height="100" border="0"
                                                   alt=""></div>
                        <div class="mainbought">100</div>
                        <div class="mainleft">30 days</div>
                    </div>

                    <div class="rightcontainer">
                        <div class="maindiscount">66%</div>
                        <div class="mainoldprice">�300</div>
                        <div class="mainprice">�99</div>
                    </div>

                    <img src="images/deals/main1.jpg" width="700" height="322" border="0" alt="">
                </div>

                <div class="goto"><input class="gotobutton" type="button" name="goto" value="BUY NOW!"></div>

                <div class="share">
                    <span class='st_facebook_vcount' displayText='Facebook'></span>
                    <span class='st_twitter_vcount' displayText='Tweet'></span>
                    <span class='st_linkedin_vcount' displayText='LinkedIn'></span>
                    <span class='st_pinterest_vcount' displayText='Pinterest'></span>
                    <span class='st_email_vcount' displayText='Email'></span>
                </div>


            </div>

            <!-- Tabs -->
            <div id="tab-container" class='tab-container'>
                <ul class='etabs'>
                    <li class='tab'><a href="#tabs1">About This Deal</a></li>
                    <li class='tab'><a href="#tabs2">How to Use This Offer</a></li>
                    <li class='tab'><a href="#tabs3">Terms And Conditions</a></li>
                    <li class='tab'><a href="#tabs4">Location</a></li>
                </ul>
                <div class='panel-container'>
                    <div id="tabs1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ante ante, dictum in pharetra
                            eu, dapibus sit amet sem. Sed at molestie ipsum. Aliquam erat volutpat. Pellentesque
                            tincidunt tristique lectus quis feugiat. Duis auctor sollicitudin gravida. Nulla gravida
                            sapien ac sagittis volutpat.</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ante ante, dictum in pharetra
                            eu, dapibus sit amet sem. Sed at molestie ipsum. Aliquam erat volutpat. Pellentesque
                            tincidunt tristique lectus quis feugiat. Duis auctor sollicitudin gravida. Nulla gravida
                            sapien ac sagittis volutpat.</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ante ante, dictum in pharetra
                            eu, dapibus sit amet sem. Sed at molestie ipsum. Aliquam erat volutpat. Pellentesque
                            tincidunt tristique lectus quis feugiat. Duis auctor sollicitudin gravida. Nulla gravida
                            sapien ac sagittis volutpat.</p>

                    </div>

                    <div id="tabs2">
                        ....
                    </div>
                    <div id="tabs3">
                        .....
                    </div>
                    <div id="tabs4"><br>
                        <iframe width="680" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="https://maps.google.co.uk/maps?q=google+map+barcelona&amp;ie=UTF8&amp;hq=&amp;hnear=Barcelona,+Catalonia,+Spain&amp;gl=uk&amp;t=m&amp;ll=41.438608,2.17186&amp;spn=0.180164,0.151062&amp;z=11&amp;iwloc=A&amp;output=embed"></iframe>
                        <br/>
                        <small><a
                                href="https://maps.google.co.uk/maps?q=google+map+barcelona&amp;ie=UTF8&amp;hq=&amp;hnear=Barcelona,+Catalonia,+Spain&amp;gl=uk&amp;t=m&amp;ll=41.438608,2.17186&amp;spn=0.180164,0.151062&amp;z=11&amp;iwloc=A&amp;source=embed"
                                style="color:#0000FF;text-align:left">View Larger Map</a></small>
                    </div>

                </div>
            </div>


            <div class="clear"></div>

        </div>
    </div>

    <div class="clear"></div>

    <div class="contentbottom">
        <!-- Other deals -->

        <h2>Other Deals:</h2>

        <div class="deal">
            <h2><a href="#">Deal 1</a></h2>

            <div class="dealimage"><a href="#"><img src="images/deals/deal2.jpg" width="225" height="147" border="0"
                                                    alt=""></a></div>
            <div class="price">�99</div>
            <div class="oldpriceholder">
                <div class="oldprice">�300</div>
            </div>
        </div>

        <div class="deal">
            <h2><a href="#">Deal 2</a></h2>

            <div class="dealimage"><a href="#"><img src="images/deals/deal3.jpg" width="225" height="147" border="0"
                                                    alt=""></a></div>
            <div class="price">�99</div>
            <div class="oldpriceholder">
                <div class="oldprice">�300</div>
            </div>
        </div>

        <div class="deal">
            <h2><a href="#">Deal 3</a></h2>

            <div class="dealimage"><a href="#"><img src="images/deals/deal4.jpg" width="225" height="147" border="0"
                                                    alt=""></a></div>
            <div class="price">�99</div>
            <div class="oldpriceholder">
                <div class="oldprice">�300</div>
            </div>
        </div>

        <div class="deal">
            <h2><a href="#">Deal 4</a></h2>

            <div class="dealimage"><a href="#"><img src="images/deals/deal1.jpg" width="225" height="147" border="0"
                                                    alt=""></a></div>
            <div class="price">�99</div>
            <div class="oldpriceholder">
                <div class="oldprice">�300</div>
            </div>
        </div>


    </div>

    <div class="clear"></div>

</div>


</div>

<!-- Footer -->
<? include_once("view/footer.php"); ?>

<?= outputHTMLEnd() ?>