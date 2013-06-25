<script src="external/js/countdown_v2.0.0/countdown.js" type="text/javascript"></script>
<style>
    #deal_of_the_day {
        height: 480px;
    }

    div.price_tag {
        width: 150px;
        height: 150px;
        background:transparent url(images/site/price_tag_circle_golden.png) ;
        left: 510px;
        top: -430px;
        position: relative;
    }

    p.price_tag_text{
        text-align: center;
        padding-top: 32px;
    }

    span.current_price {
        color: white;
        font-weight: 700;
        font-size: 40px;
    }

    span.original_price {
        color: white;
        font-weight: 700;
        font-size: 30px;
        text-decoration: line-through;

    }

    #count_down_div {
        width: 300px;
        padding: 10px;
        color: #ffffff;
    }

    #deal_of_day_banner{
        width: 700px;
        height: 80px;
        left: 0px;
        top: -270px;
        position: relative;

        background-color: #C89328;
        /* IE10 Consumer Preview */
        background-image: -ms-linear-gradient(top left, #FBE456 0%, #9B4B00 100%);

        /* Mozilla Firefox */
        background-image: -moz-linear-gradient(top left, #FBE456 0%, #9B4B00 100%);

        /* Opera */
        background-image: -o-linear-gradient(top left, #FBE456 0%, #9B4B00 100%);

        /* Webkit (Safari/Chrome 10) */
        background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0, #FBE456), color-stop(1, #9B4B00));

        /* Webkit (Chrome 11+) */
        background-image: -webkit-linear-gradient(top left, #FBE456 0%, #9B4B00 100%);

        /* W3C Markup, IE10 Release Preview */
        background-image: linear-gradient(to bottom right, #FBE456 0%, #9B4B00 100%);
    }
</style>
<div id="deal_of_the_day" class="shadow_box tile_box">
    <h3>DEAL OF THE DAY</h3>
    <img src="images/deals/21368454775.jpg" style="width: 660px; margin: 20px;"/>

    <div class="price_tag">
        <p class="price_tag_text">
            <span class="current_price">£33.33</span>
            <span class="original_price">£63.33</span>
        </p>
    </div>

    <div id="deal_of_day_banner">
        <div id="count_down_div"></div>
    </div>
</div>

<script type="application/javascript">
    var deal_countdown = new Countdown({
        time: 86400 * 3, // 86400 seconds = 1 day
        width: 300,
        height: 60,
        rangeHi: "day",
        style: "flip",	// <- no comma on last item!,
        target: "count_down_div"
    });
</script>

