<?php
namespace  modules\core\includes\classes;

class ConfigurationManager
{
    //put your code here
    public $configEntityList = [];

    public function getValueByKey($key)
    {
        $value = "";
        if (sizeof($this->configEntityList) > 0) {
            foreach ($this->configEntityList as $configurationEntity) {
                //find the configuration entity from list by key
                if ($configurationEntity->get_configuration_key() == $key) {
                    $value = $configurationEntity->get_configuration_value();
                    return $value;
                }
            }
        }
        return $value;
    }

    public function loadByUserID($user_id)
    {
        $this->configEntityList = [];
        $link = getConnection();
        $query = "SELECT 	module_config_id,
                        core_module_configuration.module_code,
                        core_module.module_name,
                        module_config_title,
                        module_config_key,
                        module_config_value,
                        module_config_desc,
                        module_config_type
                FROM core_user_subscribe_module, core_module_configuration, core_module
                WHERE core_user_subscribe_module.module_code = core_module_configuration.module_code
                AND core_module_configuration.module_code = core_module.module_code
                AND core_user_subscribe_module.user_id = " . $user_id . "
                ORDER BY core_module_configuration.module_code ASC";


        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new Configuration();
            $configurationEntity->set_configuration_id($newArray['module_config_id']);
            $configurationEntity->set_configuration_module_code($newArray['module_code']);
            $configurationEntity->set_configuration_module_name($newArray['module_name']);
            $configurationEntity->set_configuration_title($newArray['module_config_title']);
            $configurationEntity->set_configuration_key($newArray['module_config_key']);
            $configurationEntity->set_configuration_value($newArray['module_config_value']);
            $configurationEntity->set_configuration_desc($newArray['module_config_desc']);
            $configurationEntity->set_configuration_type($newArray['module_config_type']);
            array_push($this->configEntityList, $configurationEntity);
        }
    }

    public function loadByModuleCode($_module_code)
    {
        $this->configEntityList = [];
        $link = getConnection();
        $query = "SELECT 	module_config_id,
                        core_module_configuration.module_code,
                        core_module.module_name,
                        module_config_title,
                        module_config_key,
                        module_config_value,
                        module_config_desc,
                        module_config_type
                FROM    core_module_configuration, core_module
                WHERE   core_module.module_code = core_module_configuration.module_code
                AND core_module.module_code =  '" . $_module_code . "'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new Configuration();
            $configurationEntity->set_configuration_id($newArray['module_config_id']);
            $configurationEntity->set_configuration_module_code($newArray['module_code']);
            $configurationEntity->set_configuration_module_name($newArray['module_name']);
            $configurationEntity->set_configuration_title($newArray['module_config_title']);
            $configurationEntity->set_configuration_key($newArray['module_config_key']);
            $configurationEntity->set_configuration_value($newArray['module_config_value']);
            $configurationEntity->set_configuration_desc($newArray['module_config_desc']);
            $configurationEntity->set_configuration_type($newArray['module_config_type']);
            array_push($this->configEntityList, $configurationEntity);
        }
        return $this->configEntityList;
    }

    public function loadAllConfig()
    {
        $this->configEntityList = [];
        $link = getConnection();
        $query = "SELECT 	DISTINCT module_config_id,
                        core_module_configuration.module_code,
                        core_module.module_name,
                        module_config_title,
                        module_config_key,
                        module_config_value,
                        module_config_desc,
                        module_config_type
                FROM core_user_subscribe_module, core_module_configuration, core_module
                WHERE core_user_subscribe_module.module_code = core_module_configuration.module_code
                AND core_module_configuration.module_code = core_module.module_code
                ORDER BY core_module_configuration.module_code ASC";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new Configuration();
            $configurationEntity->set_configuration_id($newArray['module_config_id']);
            $configurationEntity->set_configuration_module_code($newArray['module_code']);
            $configurationEntity->set_configuration_module_name($newArray['module_name']);
            $configurationEntity->set_configuration_title($newArray['module_config_title']);
            $configurationEntity->set_configuration_key($newArray['module_config_key']);
            $configurationEntity->set_configuration_value($newArray['module_config_value']);
            $configurationEntity->set_configuration_desc($newArray['module_config_desc']);
            $configurationEntity->set_configuration_type($newArray['module_config_type']);
            array_push($this->configEntityList, $configurationEntity);
        }

        return $this->configEntityList;
    }

    public function getConfigTableDataSource($module_code)
    {
        $configList = $this->loadByModuleCode($module_code);
        $header = array("Config Title", "Config Key", "Config Value", "Config Description", "Config Datatype", "Action");
        $body = [];
        if (sizeof($configList) > 0) {
            foreach ($configList as $config) {
                array_push($body, array(
                    $config->get_configuration_title(),
                    $config->get_configuration_key(),
                    $config->get_configuration_value(),
                    $config->get_configuration_desc(),
                    $config->get_configuration_type(),
                    "<a class='icon_edit' title='Update Configuration' href='" . SERVER_URL . "admin/main.php?view=config_update&config_id=" .
                        $config->get_configuration_id() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>"
                ));
            }
        }
        $dataSource = array(
            "header" => $header,
            "body" => $body
        );
        return $dataSource;
    }
}
?>
