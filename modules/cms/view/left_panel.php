<div id="left_panel">
    <div id="panel_module_title">
    Module: <?=$GLOBAL_DEPS[$_REQUEST['module_code']]["module_name"]?>
    </div>
    <div id="left_vertical_menu">
        <ul class="top-level">
            <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=config_list"?>">Configuration</a>
            </li>
            <li><a href="#">Articles</a>
                <ul class="sub-level">
                    <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=content_list"?>">All Articles</a></li>
                    <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=content_create"?>">Create New Article</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Site Menu</a>
                <ul class="sub-level">
                    <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=menu_list"?>">All Menus</a></li>
                    <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=menu_create"?>">Create New Menu</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
