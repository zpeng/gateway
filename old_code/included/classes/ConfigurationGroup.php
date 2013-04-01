<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ConfigurationGroup
 *
 * @author ziyang
 */
class ConfigurationGroup {
//put your code here

    private $_configuration_group_id;
    private $_configuration_group_title;
    private $_configuration_group_description;
    private $_configuration_entity_list;


    public function get_configuration_group_id() {
        return $this->_configuration_group_id;
    }

    public function set_configuration_group_id($_configuration_group_id) {
        $this->_configuration_group_id = $_configuration_group_id;
    }

    public function get_configuration_group_title() {
        return $this->_configuration_group_title;
    }

    public function set_configuration_group_title($_configuration_group_title) {
        $this->_configuration_group_title = $_configuration_group_title;
    }

    public function get_configuration_group_description() {
        return $this->_configuration_group_description;
    }

    public function set_configuration_group_description($_configuration_group_description) {
        $this->_configuration_group_description = $_configuration_group_description;
    }

    public function get_configuration_entity_list() {
        if ($this->_configuration_entity_list == null){
            $this->loadConfigurationEntityList();
        }
        return $this->_configuration_entity_list;
    }

    public function set_configuration_entity_list($_configuration_entity_list) {
        $this->_configuration_entity_list = $_configuration_entity_list;
    }

    public function load($configuration_group_id) {
        $link = getConnection();
        $query="select 	configuration_group_id, 
                        configuration_group_title, 
                        configuration_group_description
                from    tb_configuration_group 
                where   configuration_group_id = ".$configuration_group_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_configuration_group_id($newArray['configuration_group_id']);
            $this->set_configuration_group_title($newArray['configuration_group_title']);
            $this->set_configuration_group_description($newArray['configuration_group_description']);
        }
    }

    private function loadConfigurationEntityList(){
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
                from    tb_configuration
                where   configuration_group_id = ".$this->get_configuration_group_id();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $configurationEntity = new Configuration();
            $configurationEntity->set_configuration_id($newArray['configuration_id']);
            $configurationEntity->set_configuration_group_id($newArray['configuration_group_id']);
            $configurationEntity->set_configuration_title($newArray['configuration_title']);
            $configurationEntity->set_configuration_key($newArray['configuration_key']);
            $configurationEntity->set_configuration_value($newArray['configuration_value']);
            $configurationEntity->set_configuration_description($newArray['configuration_description']);
            $configurationEntity->set_configuration_datatype($newArray['configuration_datatype']);
            $configurationEntityList[$count] = $configurationEntity;
            $count++;
        }
        $this->set_configuration_entity_list($configurationEntityList);
    }

    public function updateConfigurationEntityList(){
        if (sizeof($this->get_configuration_entity_list())>0){
            foreach($this->get_configuration_entity_list() as $configurationEntity){
                $configurationEntity->update();
            }
        }
    }

    public function setConfigurationKeyAndValue($key, $value){
        if (sizeof($this->get_configuration_entity_list())>0){
            foreach($this->get_configuration_entity_list() as $configurationEntity){
                //find the configuration entity from list by key
                if ($configurationEntity->get_configuration_key() == $key){
                    //update its value
                   $configurationEntity->set_configuration_value($value);
                }
            }
        }
    }
}
?>
