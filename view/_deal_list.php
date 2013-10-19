<div id="deal_list" class="tile_box_borderless">
    <h3>MORE DEALS</h3>
    <?
    use modules\deal_steal\includes\classes\DealManager;
    $dealManager = new DealManager();
    $deal_list = $dealManager->loadAllDeals();
    if (sizeof($deal_list) > 0) {
        foreach ($deal_list as $deal) {
            echo "<div class='deal_thumbmail shadow_box round_corner_box_3px'>";
            echo "<h3 class='deal_thumbmail_title'>" . $deal->getTitle() . "</h3>";
            echo "<img border='0' class='deal_thumbmail_pic'
            alt='" . $deal->getTitle() . "'
            src='" . SERVER_URL . "images/deals/" . $deal->getImage() . "' />";
            echo "<span class='deal_thumbmail_original_price'>£ " . $deal->getOriginalPrice() . "</span>";
            echo "<ul class='price_tag'>
                  <li><a href='#'>£ " . $deal->getOfferPrice() . "</a></li>
                  </ul>";
            echo "</div>";
        }
    }
    ?>
    <br class="clear"/>
</div>

