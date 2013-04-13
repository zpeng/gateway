<div id="left_panel">
    <div id="panel_module_title">
    Module: <?=$GLOBAL_DEPS[$_REQUEST['module_code']]["module_name"]?>
    </div>
    <div id="left_vertical_menu">
        <ul class="top-level">
            <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=config_list"?>">Configuration</a>
            </li>
            <li><a href="#">User Management</a>
                <ul class="sub-level">
                    <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=user_list"?>">Show All Users</a></li>
                    <li><a href="<?=SERVER_URL."admin/main.php?module_code=".$_REQUEST['module_code']."&view=user_create"?>">Create New User</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
