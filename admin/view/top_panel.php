<div id="top_panel">
    Available modules:
    <?php
    $count = 0;
    foreach ($s_user_session->userModuleAccessNameList as $module_name) {
        echo "<a class='module_item' href='main.php?module_code=" . $s_user_session->userModuleAccessCodeList[$count] . "&view=default'>" . $module_name . "</a>";
        $count++;
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