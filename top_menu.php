<div class="menu-bg">
    <div class="menu-right-bg">
        <div class="clear menu-left-bg">
            <div id="topmenu">
                <ul class="menu-nav">
                    <?
                    //get the top part of the menu
                    $menuType = new MenuType();
                    $menuType->load(1);
                    $menuList = $menuType->getMenuItemListByMenuType();

                    if (sizeof($menuList) > 0 ) {
                        foreach($menuList as $menu) {
                            $menuDesc = new MenuDescription();
                            $menuDesc = $menu->loadMenuDescriptionByLanguageID($s_language_id);
                            if($menuDesc == null) {
                                $menuDesc = $menu->getDefaultMenuDescription();
                            }

                            echo "<li><a href='".$menu->get_menu_link()."'><span>".$menuDesc->get_menu_name()."</span></a>";

                            $subMenuList = null;
                            $subMenuList = $menu->getSubMenuItemList();
                            if($subMenuList != null) {
                                echo " <div><ul>";
                                foreach($subMenuList as $subMenu) {
                                    $menuDesc = new MenuDescription();
                                    $menuDesc = $subMenu->loadMenuDescriptionByLanguageID($_language_id);
                                    if($menuDesc == null) {
                                        $menuDesc = $subMenu->getDefaultMenuDescription();
                                    }
                                    echo "<li ><a href='".$subMenu->get_menu_link()."'>".$menuDesc->get_menu_name()."</a></li>";
                                }
                                echo "</ul></div>";
                            }
                            echo "</li>";
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
</div>





