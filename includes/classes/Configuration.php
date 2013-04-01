<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Configuration
 *
 * @author ziyang
 */
class Configuration {
    //put your code here
    public $configuration_id;
    public $configuration_module_id;
    public $configuration_title;
    public $configuration_key;
    public $configuration_value;
    public $configuration_description;
    public $configuration_datatype;



    public function get_configuration_id() {
        return $this->configuration_id;
    }

    public function set_configuration_id($_configuration_id) {
        $this->configuration_id = $_configuration_id;
    }

    public function get_configuration_module_id() {
        return $this->configuration_module_id;
    }

    public function set_configuration_module_id($_configuration_module_id) {
        $this->configuration_module_id = $_configuration_module_id;
    }

    public function get_configuration_title() {
        return $this->configuration_title;
    }

    public function set_configuration_title($_configuration_title) {
        $this->configuration_title = $_configuration_title;
    }

    public function get_configuration_key() {
        return $this->configuration_key;
    }

    public function set_configuration_key($_configuration_key) {
        $this->configuration_key = $_configuration_key;
    }

    public function get_configuration_value() {
        return $this->configuration_value;
    }

    public function set_configuration_value($_configuration_value) {
        $this->configuration_value = $_configuration_value;
    }

    public function get_configuration_description() {
        return $this->configuration_description;
    }

    public function set_configuration_description($_configuration_description) {
        $this->configuration_description = $_configuration_description;
    }

    public function get_configuration_datatype() {
        return $this->configuration_datatype;
    }

    public function set_configuration_datatype($_configuration_datatype) {
        $this->configuration_datatype = $_configuration_datatype;
    }


    public function update() {
        $link = getConnection();
        $query = "UPDATE core_configuration
                  SET    configuration_value = '".$this->get_configuration_value()."'
                  WHERE  configuration_id    = ".$this->get_configuration_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function outputConfigEntityAsHTML() {
        $field = "";
        switch ($this->get_configuration_datatype()) {
            case "string" :
                $field = $this->output_config_entity_datatype_string_as_html(400);
                break;
            case "text" :
                $field = $this->output_config_entity_datatype_text_as_html(400);
                break;
            case "number" :
                $field = $this->output_config_entity_datatype_number_as_html(100);
                break;
            case "boolean" :
                $field = $this->output_config_entity_datatype_boolean_as_html(50);
                break;
        }
        return $field;
    }

    private function output_config_entity_datatype_string_as_html($width="100") {
        $field = "<input name='".$this->get_configuration_key()."'
                         id='".$this->get_configuration_key()."'
                         style='width: ".$width."px'
                         value='".$this->get_configuration_value()."'/>";
        return $field;
    }

    private function output_config_entity_datatype_number_as_html($width="100") {
        $field = "<input name='".$this->get_configuration_key()."'
                         id='".$this->get_configuration_key()."'
                         style='width: ".$width."px'
                         value='".$this->get_configuration_value()."'/>";
        return $field;
    }

    private function output_config_entity_datatype_boolean_as_html($width="100") {
        $field = "<select name='".$this->get_configuration_key()."'
                          id='".$this->get_configuration_key()."'
                          style='width:".$width."px' >";


        if ("Y" == $this->get_configuration_value()) {
            $field= $field."<option  selected='selected' value='Y'>Yes</option>";
            $field= $field."<option  value='N'>No</option>";
        }else {
            $field= $field."<option  value='Y'>Yes</option>";
            $field= $field."<option  selected='selected'  value='N'>No</option>";
        }
        $field= $field."</select>";
        return $field;
    }

    private function output_config_entity_datatype_text_as_html($width="100") {
        $field = "<textarea name='".$this->get_configuration_key()."'
                         id='".$this->get_configuration_key()."'
                         style='width: ".$width."px'
                         rows='5'>".$this->get_configuration_value()."</textarea>";
        return $field;
    }

}
?>
