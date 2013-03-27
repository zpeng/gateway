<?php

require_once('../../included/class_loader.php') ;
;
$url = "../index.php?view=admin_menu_list"; // target of the redirect

$menu = new Menu();

$menu_type_id = secureRequestParameter($_REQUEST["menu_type_id"]);
$menu_type = new MenuType();
$menu_type->load($menu_type_id);
$menu->set_menu_type($_menu_type);
$menu->set_menu_type_id($menu_type_id);

$menu_parent_id = secureRequestParameter($_REQUEST["menu_parent_id"]);
$menu->set_menu_parent_id($menu_parent_id);

$menu_order = secureRequestParameter($_REQUEST["menu_order"]);
$menu->set_menu_order($menu_order);


$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();

$menuDescriptionList;
if (sizeof($languageList) > 0) {
    $language = new Language();
    $count=0;
    foreach($languageList as $language) {
        $menu_name = secureRequestParameter($_REQUEST["menu_name".$count]);

        $menuDescription = new MenuDescription();
        $menuDescription->set_language($language);
        $menuDescription->set_language_id($language->get_language_id());
        $menuDescription->set_menu_name($menu_name);

        $menuDescriptionList[$count] = $menuDescription;
        $count++;
    }
}

$menu->set_menu_description_list($menuDescriptionList);



// get menu link
$link_type_id =  secureRequestParameter($_REQUEST["link_type_id"]);


if ($link_type_id == 0) {
    //customerized link
    $menu_link =  secureRequestParameter($_REQUEST["menu_link"]);
    $link=$menu_link;

}else if ($link_type_id == 1) {
    // content list
    $content_id = secureRequestParameter($_REQUEST['content_id']);

    $content = new Content();
    $content->load($content_id);
    $content_description = new ContentDescription();
    $content_description = $content->get_first_content_description();
    $link="index.php?content_id=".$content->get_content_id()."&view=content&title=".trim(str_replace(" ","-",$content_description->get_title()));
    
}


$menu->set_menu_link($link);

$menu->insert();

$url=$url."&menu_id=".$menu_id;
header( "Location: ".$url );

?>


