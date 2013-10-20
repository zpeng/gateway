<div id="header">
    <a href="index.php">
        <div id="logo"></div>
    </a>

    <div id="search_region">
        <div class="map"><img src="images/uk_map.png" width="53" height="67" border="0" alt=""></div>
        <?
        if (isset($_SESSION['client_is_login']) && $_SESSION['client_is_login'] == true) {
            ?>
            <div class="welcome">Welcome <span class="name"><?=$_SESSION['client_name']?></span> | <a
                    href="control/logout.php">Logout?</a></div>
        <? } else { ?>
            <div class="login"><a href="index.php?view=login">Login</a> | <a href="index.php?view=register">Register</a>
            </div>
        <? } ?>
        <div class="search">
            <form action="">
                <input type="text" name="searchtext" class="searchtext" value="I am looking for">

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
            <form action="">
                <input type="text" name="signuptext" class="signuptext" value="Your email address">
                <input type="image" name="signupsubmit" class="signupsubmit" src="images/button_go.png">
            </form>
        </div>

    </div>
    <div id="concierge">
        <img src="images/icon_concierge.png" width="65" height="61" border="0" alt=""><br>
        <strong>Concierge
            option</strong>
    </div>
</div>