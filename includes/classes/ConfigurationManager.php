<?php

class ConfigurationManager {
    //put your code here
    public $configEntityList = [];

    public function loadByUserID($user_id) {
        $this->configEntityList =[];
        $count = 0;
        $link = getConnection();
        $query="SELECT 	module_config_id,
                        core_module_configuration.module_id,
                        core_module.module_name,
                        module_config_title,
                        module_config_key,
                        module_config_value,
                        module_config_desc,
                        module_config_type
                FROM core_user_module_access, core_module_configuration, core_module
                WHERE core_user_module_access.module_id = core_module_configuration.module_id
                AND core_module_configuration.module_id = core_module.module_id
                AND core_user_module_access.user_id = ".$user_id."
                ORDER BY core_module_configuration.module_id ASC";


        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new Configuration();
            $configurationEntity->set_configuration_id($newArray['module_config_id']);
            $configurationEntity->set_configuration_module_id($newArray['module_id']);
            $configurationEntity->set_configuration_module_name($newArray['module_name']);
            $configurationEntity->set_configuration_title($newArray['module_config_title']);
            $configurationEntity->set_configuration_key($newArray['module_config_key']);
            $configurationEntity->set_configuration_value($newArray['module_config_value']);
            $configurationEntity->set_configuration_desc($newArray['module_config_desc']);
            $configurationEntity->set_configuration_type('module_config_type');
            $this->configEntityList[$count] = $configurationEntity;
            $count++;
        }
    }

    public function getValueByKey($key) {
        $value = "";
        if (sizeof($this->configEntityList) >0) {
            foreach($this->configEntityList as $configurationEntity) {
                //find the configuration entity from list by key
                if ($configurationEntity->get_configuration_key() == $key) {
                    $value = $configurationEntity->get_configuration_value();
                    return $value;
                }
            }
        }
        return $value;
    }

    public function loadByModuleID($_module_id) {
        $this->configEntityList =[];
        $count = 0;
        $link = getConnection();
        $query="SELECT 	module_config_id,
                        core_module_configuration.module_id,
                        core_module.module_name,
                        module_config_title,
                        module_config_key,
                        module_config_value,
                        module_config_desc,
                        module_config_type
                FROM    core_module_configuration, core_module
                WHERE   core_module.module_id = core_module_configuration.module_id
                AND core_module_configuration.module_id =  ".$_module_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new Configuration();
            $configurationEntity->set_configuration_id($newArray['module_config_id']);
            $configurationEntity->set_configuration_module_id($newArray['module_id']);
            $configurationEntity->set_configuration_module_name($newArray['module_name']);
            $configurationEntity->set_configuration_title($newArray['module_config_title']);
            $configurationEntity->set_configuration_key($newArray['module_config_key']);
            $configurationEntity->set_configuration_value($newArray['module_config_value']);
            $configurationEntity->set_configuration_desc($newArray['module_config_desc']);
            $configurationEntity->set_configuration_type('module_config_type');
            $this->configEntityList[$count] = $configurationEntity;
            $count++;
        }
    }

    public function loadAllConfigAsJSON() {
        $this->configEntityList =[];
        $count = 0;
        $link = getConnection();
        $query="SELECT 	module_config_id,
                        core_module_configuration.module_id,
                        core_module.module_name,
                        module_config_title,
                        module_config_key,
                        module_config_value,
                        module_config_desc,
                        module_config_type
                FROM core_user_module_access, core_module_configuration, core_module
                WHERE core_user_module_access.module_id = core_module_configuration.module_id
                AND core_module_configuration.module_id = core_module.module_id
                ORDER BY core_module_configuration.module_id ASC";


        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new Configuration();
            $configurationEntity->set_configuration_id($newArray['module_config_id']);
            $configurationEntity->set_configuration_module_id($newArray['module_id']);
            $configurationEntity->set_configuration_module_name($newArray['module_name']);
            $configurationEntity->set_configuration_title($newArray['module_config_title']);
            $configurationEntity->set_configuration_key($newArray['module_config_key']);
            $configurationEntity->set_configuration_value($newArray['module_config_value']);
            $configurationEntity->set_configuration_desc($newArray['module_config_desc']);
            $configurationEntity->set_configuration_operation("<a href=\"www.google.com\">update</a>");

            $this->configEntityList[$count] = $configurationEntity;
            $count++;
        }

        return  str_replace('\\u0000', "", json_encode( (array) $this->configEntityList ));
    }
}
?>
