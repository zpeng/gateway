<div id="left_panel">
    <div id="panel_module_title">
    Module: <?=$GLOBAL_DEPS[$_REQUEST['module_code']]["module_name"]?>
    </div>
    <div id="left_vertical_menu">
        <ul class="top-level">
            <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=config_list"?>">Configuration</a></li>
            <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=category"?>">Category</a></li>
            <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=city_list"?>">Location/City</a></li>
            <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=tags"?>">Tags</a></li>


            <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=deal_category"?>">Client Manager</a></li>
            <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=deal_category"?>">Deal Manager</a></li>
        </ul>
    </div>
</div>
