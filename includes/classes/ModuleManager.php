<?php
class ModuleManager {
    public function getModuleList() {
        $moduleList = [];
        $count =  0;
        $link = getConnection();

        $query = " select module_id,
                        module_name,
                        module_code,
                        module_desc,
                        module_archived
                from    core_module
                where   module_archived =   'N'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $module = new Module();
            $module->set_module_id($newArray['module_id']);
            $module->set_module_name($newArray['module_name']);
            $module->set_module_code($newArray['module_code']);
            $module->set_module_desc($newArray['module_desc']);
            $module->set_module_archived($newArray['module_archived']);

            $moduleList[$count] = $module;
            ++$count;
        }
        return $moduleList;
    }

    public function getModuleListAsJSON(){
        return  str_replace('\\u0000', "", json_encode( (array) $this->getModuleList() ));
    }


}
?>