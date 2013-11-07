<div id="header">
    <a href="index.php">
        <div id="logo"></div>
    </a>

    <div id="search_region">
        <div class="map"><img src="images/uk_map.png" width="53" height="67" border="0" alt=""></div>
        <?
        if (isset($_SESSION['client_is_login']) && $_SESSION['client_is_login'] == true) {
            ?>
            <div class="welcome">Welcome <span class="name"><?= $_SESSION['client_name'] ?></span> | <a
                    href="control/logout.php">Logout?</a></div>
        <? } else { ?>
            <div class="login"><a href="index.php?view=login">Login</a> | <a href="index.php?view=register">Register</a>
            </div>
        <? } ?>
        <div class="search">
            <form action="">
                <input type="text" name="searchtext" class="searchtext" value="I am looking for"
                       onfocus="if(this.value=='I am looking for') this.value='';">

                <div class="searchselect">
                    <div class="searchselectimg">
                        <select name="searcharea" class="searcharea">
                            <?
                            use modules\deal_steal\includes\classes\City;
                            use modules\deal_steal\includes\classes\CityManager;

                            $cityManager = new CityManager();
                            $city_list = $cityManager->loadCityList();
                            if (sizeof($city_list) > 0) {
                                foreach ($city_list as $city) {
                                    echo "<option value='" . $city->getCityId() . "'>" . $city->getCityName() . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="image" name="searchsubmit" class="searchsubmit" src="images/button_search.png">
            </form>
        </div>
    </div>
    <div id="cart_region">
        <a href="index.php?view=shopping_cart">
            <div id="cart">
                SHOPPING CART: <?
                echo $client_order->getQuantity();
                ?> items
            </div>
        </a>

        <div class="welcome clear">Sign up for deals in <span class="name">London</span></div>
        <div class="signup">
            <form id="clientNewsletterSubscribeForm" method='post'>
                <input type="text" name="sub_email" id="sub_email" class="signuptext" value="Your email address"
                       onfocus="if(this.value=='Your email address') this.value='';">
                <input type="image" src="images/button_go.png">
            </form>
            <div id="client_subscribe_dialog" style="">
                Thank you for subscribing with us!
            </div>
        </div>
        <script>
            // load css
            head.js(<?=outputDependencies(
    array("simplemodal-css")
    , $CSS_DEPS)?>);

            // load js
            head.js(<?=outputDependencies(
    array("simplemodal")
    , $JS_DEPS)?>, function () {
                $('form#clientNewsletterSubscribeForm').submit(function () {
                    $.ajax({
                        url: 'control/ajax_service.php', //your server side script
                        data: {
                            email: $('#sub_email').val(),
                            operation_id: "client_subscribe" }, //our data
                        type: 'POST',
                        success: function (data) {
                            $("#client_subscribe_dialog").modal({
                                overlayClose: false,
                                maxHeight : 60,
                                autoResize: true,
                                autoPosition: true
                            });
                        },
                        error: function (jxhr, msg, err) {
                            console.log(msg);
                        }
                    });
                    return false;
                });
            });
        </script>

    </div>
    <div id="concierge">
        <img src="images/icon_concierge.png" width="65" height="61" border="0" alt=""><br>
        <strong>Concierge
            option</strong>
    </div>
</div>