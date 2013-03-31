<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of MenuManager
 *
 * @author ziyang
 */
class MenuManager {
    //put your code here
    public function getMenuTypeList() {
        $menuTypelist;
        $count = 0;

        $link = getConnection();

        $query="    SELECT menu_type_id         ,
                       menu_type_name       ,
                       menu_type_description,
                       menu_type_archived
                FROM   tb_menu_type
                WHERE  menu_type_archived = 'N'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $menuType = new MenuType();
            $menuType->set_menu_type_id($newArray['menu_type_id']);
            $menuType->set_menu_type_name($newArray['menu_type_name']);
            $menuType->set_menu_type_description($newArray['menu_type_description']);
            $menuType->set_menu_type_archived($newArray['menu_type_archived']);

            $menuTypelist[$count] = $menuType;
            $count++;
        }
        return $menuTypelist;
    }
}
?>
