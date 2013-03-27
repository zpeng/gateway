<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ConfigurationManager
 *
 * @author ziyang
 */
class ConfigurationManager {
    //put your code here
    private $_configEntityList;

    static public function cast(ConfigurationManager $object) {
        return $object;
    }


    function __construct() {
        $this->load();
    }

    private function load() {
        $configurationEntityList = null;
        $count = 0;
        $link = getConnection();
        $query="select 	configuration_id,
                        configuration_group_id,
                        configuration_title,
                        configuration_key,
                        configuration_value,
                        configuration_description,
                        configuration_datatype
                from    tb_configuration ";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new ConfigurationEntity();
            $configurationEntity->set_configuration_id($newArray['configuration_id']);
            $configurationEntity->set_configuration_group_id($newArray['configuration_group_id']);
            $configurationEntity->set_configuration_title($newArray['configuration_title']);
            $configurationEntity->set_configuration_key($newArray['configuration_key']);
            $configurationEntity->set_configuration_value($newArray['configuration_value']);
            $configurationEntity->set_configuration_description($newArray['configuration_description']);
            $configurationEntity->set_configuration_datatype('configuration_datatype');
            $configurationEntityList[$count] = $configurationEntity;
            $count++;
        }
        $this->_configEntityList= $configurationEntityList;
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

    public function getConfigurationGroupList() {
        $configurationGroupList = null;
        $count = 0;
        $link = getConnection();
        $query="select 	configuration_group_id,
                        configuration_group_title,
                        configuration_group_description
                from    tb_configuration_group ";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationGroup = new ConfigurationGroup();
            $configurationGroup->set_configuration_group_id($newArray['configuration_group_id']);
            $configurationGroup->set_configuration_group_title($newArray['configuration_group_title']);
            $configurationGroup->set_configuration_group_description($newArray['configuration_group_description']);
            $configurationGroupList[$count] = $configurationGroup;
            $count++;
        }
        return $configurationGroupList;

    }
}
?>
