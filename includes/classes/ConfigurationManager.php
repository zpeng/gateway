<?php

class ConfigurationManager {
    //put your code here
    public $configEntityList = [];

    function __construct($user_id) {
        $this->loadByUserID($user_id);
    }

    private function loadByUserID($user_id) {
        $this->configEntityList =[];
        $count = 0;
        $link = getConnection();
        $query="select 	module_config_id,
                        core_module_configuration.module_id,
                        module_config_title,
                        module_config_key,
                        module_config_value,
                        module_config_desc,
                        module_config_type
                FROM core_user_module_access, core_module_configuration
                WHERE core_user_module_access.module_id = core_module_configuration.module_id
                AND core_user_module_access.user_id = ".$user_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new Configuration();
            $configurationEntity->set_configuration_id($newArray['module_config_id']);
            $configurationEntity->set_configuration_module_id($newArray['module_id']);
            $configurationEntity->set_configuration_title($newArray['module_config_title']);
            $configurationEntity->set_configuration_key($newArray['module_config_key']);
            $configurationEntity->set_configuration_value($newArray['module_config_value']);
            $configurationEntity->set_configuration_description($newArray['module_config_desc']);
            $configurationEntity->set_configuration_datatype('module_config_type');
            $this->configEntityList[$count] = $configurationEntity;
            $count++;
        }
    }

    public function getValueByKey($key) {
        $value = "";
        if (sizeof($this->_configEntityList) >0) {
            foreach($this->_configEntityList as $configurationEntity) {
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
        $query="select 	module_config_id,
                        module_id,
                        module_config_title,
                        module_config_key,
                        module_config_value,
                        module_config_desc,
                        module_config_type
                from    core_module_configuration
                where   module_id = ".$_module_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new Configuration();
            $configurationEntity->set_configuration_id($newArray['module_config_id']);
            $configurationEntity->set_configuration_module_id($newArray['module_id']);
            $configurationEntity->set_configuration_title($newArray['module_config_title']);
            $configurationEntity->set_configuration_key($newArray['module_config_key']);
            $configurationEntity->set_configuration_value($newArray['module_config_value']);
            $configurationEntity->set_configuration_description($newArray['module_config_desc']);
            $configurationEntity->set_configuration_datatype('module_config_type');
            $this->configEntityList[$count] = $configurationEntity;
            $count++;
        }
    }

}
?>
