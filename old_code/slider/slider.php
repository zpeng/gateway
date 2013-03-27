<link rel="stylesheet" type="text/css" href="slider/css/style.css">
<script language="javascript" type="text/javascript" src="slider/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="slider/js/jquery_002.js"></script>
<script language="javascript" type="text/javascript" src="slider/js/script.js"></script>
<script type="text/javascript">
    $(document).ready( function(){
        var buttons = { previous:$('#lofslidecontent45 .lof-previous') ,
            next:$('#lofslidecontent45 .lof-next') };

        $obj = $('#lofslidecontent45').lofJSidernews( { interval : 4000,
            direction		: 'opacity',
            easing			: 'easeOutBounce',
            duration		: 1200,
            auto		 	: true,
            mainWidth:                    700,
            buttons			: buttons} );
    });
</script>

<!------------------------------------- THE CONTENT ------------------------------------------------>
<div id="lofslidecontent45" class="lof-slidecontent" style="width:100%; height: 250px; margin-bottom: 10px">
    <div style="display: none;" class="preload"><div></div></div>
    <!-- MAIN CONTENT -->
    <div class="lof-main-outer" style="width:100%; height: 250px;">

        <div onclick="return false" href="" class="lof-previous"></div>
        <ul class="lof-main-wapper lof-opacity">
            <li style="opacity: 0;">
                <img src="slider/images/image001.jpg" title="Light Zone">
            </li>
            <li style="opacity: 0;">
                <img src="slider/images/image002.jpg" title="Light Zone">
            </li>
            <!--
            <li style="opacity: 0;">
                <img src="slider/images/image003.jpg" title="Light Zone">
            </li>
            <li style="opacity: 0;">
                <img src="slider/images/image004.jpg" title="Light Zone">
            </li>
            -->

        </ul>
        <div onclick="return false" href="" class="lof-next"></div>
    </div>
</div>