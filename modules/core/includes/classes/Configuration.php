<?php
namespace  modules\core\includes\classes;

class Configuration
{
    //put your code here
    public $configuration_id;
    public $configuration_module_code;
    public $configuration_module_name;
    public $configuration_title;
    public $configuration_key;
    public $configuration_value;
    public $configuration_desc;
    public $configuration_type;
    public $configuration_operation;


    public function get_configuration_id()
    {
        return $this->configuration_id;
    }

    public function set_configuration_id($_configuration_id)
    {
        $this->configuration_id = $_configuration_id;
    }

    public function get_configuration_module_code()
    {
        return $this->configuration_module_code;
    }

    public function set_configuration_module_code($_configuration_module_code)
    {
        $this->configuration_module_code = $_configuration_module_code;
    }

    public function get_configuration_module_name()
    {
        return $this->configuration_module_name;
    }

    public function set_configuration_module_name($_configuration_module_name)
    {
        $this->configuration_module_name = $_configuration_module_name;
    }

    public function get_configuration_title()
    {
        return $this->configuration_title;
    }

    public function set_configuration_title($_configuration_title)
    {
        $this->configuration_title = $_configuration_title;
    }

    public function get_configuration_key()
    {
        return $this->configuration_key;
    }

    public function set_configuration_key($_configuration_key)
    {
        $this->configuration_key = $_configuration_key;
    }

    public function get_configuration_value()
    {
        return $this->configuration_value;
    }

    public function set_configuration_value($_configuration_value)
    {
        $this->configuration_value = $_configuration_value;
    }

    public function get_configuration_desc()
    {
        return $this->configuration_desc;
    }

    public function set_configuration_desc($_configuration_desc)
    {
        $this->configuration_desc = $_configuration_desc;
    }

    public function get_configuration_type()
    {
        return $this->configuration_type;
    }

    public function set_configuration_type($_configuration_type)
    {
        $this->configuration_type = $_configuration_type;
    }

    public function set_configuration_operation($_configuration_operation)
    {
        $this->configuration_operation = $_configuration_operation;
    }

    public function update()
    {
        $link = getConnection();
        $query = "UPDATE core_module_configuration
                  SET    module_config_value = '" . $this->get_configuration_value() . "'
                  WHERE  module_config_id    = " . $this->get_configuration_id();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function loadById($id)
    {   $link = getConnection();
        $query = "SELECT  module_config_id,
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
                AND module_config_id = ".$id;


        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_configuration_id($newArray['module_config_id']);
            $this->set_configuration_module_code($newArray['module_code']);
            $this->set_configuration_module_name($newArray['module_name']);
            $this->set_configuration_title($newArray['module_config_title']);
            $this->set_configuration_key($newArray['module_config_key']);
            $this->set_configuration_value($newArray['module_config_value']);
            $this->set_configuration_desc($newArray['module_config_desc']);
            $this->set_configuration_type($newArray['module_config_type']);
        }
    }
}
?>
