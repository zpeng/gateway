<?php
class ModuleManager
{
    public function getModuleList()
    {
        $moduleList = [];
        $count = 0;
        $link = getConnection();

        $query = " select module_name,
                        module_code,
                        module_desc,
                        module_archived
                from    core_module
                where   module_archived =   'N'
                ORDER BY (CASE WHEN module_name='System Core' THEN 0 ELSE 2 END)";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $module = new Module();
            $module->set_module_name($newArray['module_name']);
            $module->set_module_code($newArray['module_code']);
            $module->set_module_desc($newArray['module_desc']);
            $module->set_module_archived($newArray['module_archived']);

            $moduleList[$count] = $module;
            ++$count;
        }
        return $moduleList;
    }

    public function outputModuleListAsHtmlCheckboxList()
    {
        $html = "<ul class='checkbox_list'>";
        if (sizeof($this->getModuleList()) > 0) {
            foreach ($this->getModuleList() as $module) {
                $html = $html . "<li><input type='checkbox' name='subscribe_module_code_list[]' value='" . $module->get_module_code() . "'><label>" . $module->get_module_name() . "</label>";
            }
        }
        return $html = $html . "</ul>";
    }

    public function getModuleListAsJSON()
    {
        return str_replace('\\u0000', "", json_encode((array)$this->getModuleList()));
    }


}

?>