<div id="top_panel">
    Available modules:
    <?php
    foreach ($s_user_session->user_subscribe_module_code_name_map as $module_code => $module_name) {
        echo "<a class='module_item' href='main.php?module_code=" .$module_code . "&view=default'>" . $module_name . "</a>";
    }
    ?>

    <!--
    <div class="menu">
        <ul>
            <li><a href="#"><img src="images/star.jpg" />&nbsp;Global Setting</a>
                <ul>
                    <li><a href="index.php?view=admin_configuration"><img src="images/configuration.png" />&nbsp;Configuration</a></li>
                    <li><a href="index.php?view=admin_admin_list"><img src="images/admin.png" />&nbsp;Administrators</a></li>
                </ul>
            </li>
        </ul>
    </div>
    -->
</div>