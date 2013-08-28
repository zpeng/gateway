<?php
namespace  modules\core\includes\classes;

class ModuleManager
{
    public function getModuleList()
    {
        $moduleList = array();
        $link = getConnection();

        $query = " select module_name,
                        module_code,
                        module_desc,
                        active
                from    core_module
                where   active =   'Y'
                ORDER BY (CASE WHEN module_name='System Core' THEN 0 ELSE 2 END)";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $module = new Module();
            $module->set_module_name($newArray['module_name']);
            $module->set_module_code($newArray['module_code']);
            $module->set_module_desc($newArray['module_desc']);
            $module->setActive($newArray['active']);

            array_push($moduleList, $module);
        }
        return $moduleList;
    }

    public function getModuleCheckboxListDataSource()
    {
        $module_list = $this->getModuleList();
        $data = array();
        if (sizeof($module_list) > 0) {
            foreach ($module_list as $module) {
                $data[$module->get_module_name()] = $module->get_module_code();
            }
        }
        $dataSource = array(
            "data" => $data
        );
        return $dataSource;
    }
}

?>