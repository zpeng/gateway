<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of LanguageManager
 *
 * @author ziyang
 */
class LanguageManager {
    //put your code here
    public function getLanguageDefaultList() {
        $languageDefaultList;
        $count = 0;
        $link = getConnection();
        $query="select 	language_default_id, language_default_name, language_default_initial,language_default_icon,language_default_archived
                from	cms_language_default
                where   language_default_archived = 'N'";

        $result = executeNonUpdateQuery($link , $query);

        while ($newArray = mysql_fetch_array($result)) {
            $languageDefault = new LanguageDefault();
            $languageDefault->set_language_default_id($newArray['language_default_id']);
            $languageDefault->set_language_default_name($newArray['language_default_name']);
            $languageDefault->set_language_default_initial($newArray['language_default_initial']);
            $languageDefault->set_language_default_icon($newArray['language_default_icon']);
            $languageDefault->set_language_default_archived($newArray['language_default_archived']);

            $languageDefaultList[$count] = $languageDefault;
            $count++;
        }

        closeConnection($link);
        return $languageDefaultList;
    }

    public function getLanguageList() {
        $languageList;
        $count = 0;
        $link = getConnection();
        $query="select 	language_id, language_name, language_initial,language_icon,language_archived
                from	cms_language
                where   language_archived = 'N'";

        $result = executeNonUpdateQuery($link , $query);

        while ($newArray = mysql_fetch_array($result)) {
            $language = new Language();
            $language->set_language_id($newArray['language_id']);
            $language->set_language_name($newArray['language_name']);
            $language->set_language_initial($newArray['language_initial']);
            $language->set_language_icon($newArray['language_icon']);
            $language->set_language_archived($newArray['language_archived']);

            $languageList[$count] = $language;
            $count++;
        }

        closeConnection($link);
        return $languageList;
    }
}
?>
