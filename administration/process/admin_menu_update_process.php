<?php

require_once('../../included/class_loader.php') ;


$menu_id = secureRequestParameter($_REQUEST["menu_id"]);
$menu_order = secureRequestParameter($_REQUEST["menu_order"]);
$menu_link = secureRequestParameter($_REQUEST["menu_link"]);

$menu = new Menu();
$menu->load($menu_id);


$menu->set_menu_order($menu_order);
$menu->set_menu_link($menu_link);
$menu->set_menu_archived("N");




$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();


$menuDescList = null;
if (sizeof($languageList) > 0) {
    $language = new Language();
    $count=0;
    foreach($languageList as $language) {
        $menuDescription = new MenuDescription();
        $menuDescription = $menu->loadMenuDescriptionByLanguageID($language->get_language_id());

        if ($menuDescription != null) {
            $menu_name = secureRequestParameter($_REQUEST["menu_name".$count]);
            $menuDescription->set_menu_name($menu_name);
        }else {
            $menuDescription = new MenuDescription();
            $menu_name =  secureRequestParameter($_REQUEST["menu_name".$count]);

            $menuDescription->set_menu_name($menu_name);
            $menuDescription->set_language($language);
            $menuDescription->set_language_id($language->get_language_id());
            $menuDescription->set_menu_id($menu_id);
        }
        $menuDescList[$count] = $menuDescription;
        $count++;
    }
}

$menu->set_menu_description_list($menuDescList);

$menu->update();


$url = "../index.php?view=admin_menu_update&menu_id=".$menu_id; // target of the redirect
$msg = "The menu item has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


