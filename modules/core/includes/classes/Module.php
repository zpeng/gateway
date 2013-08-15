<?php
namespace  modules\core\includes\classes;

class Module {
    public $module_code;
    public $module_name;
    public $module_desc;
    public $active;

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function get_module_name() {
        return $this->module_name;
    }

    public function set_module_name($_module_name) {
        $this->module_name = $_module_name;
    }

    public function get_module_code() {
        return $this->module_code;
    }

    public function set_module_code($_module_code) {
        $this->module_code = $_module_code;
    }

    public function get_module_desc() {
    return $this->module_desc;
}

    public function set_module_desc($_module_desc) {
        $this->module_desc = $_module_desc;
    }

    public function loadByModuleCode($_module_code) {
        $link = getConnection();
        $query = " select  module_name,
                        module_code,
                        module_desc,
                        active
                from    core_module
                where   active =   'Y'
                and     module_code =  '".$_module_code."'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_module_name($newArray['module_name']);
            $this->set_module_code($newArray['module_code']);
            $this->set_module_desc($newArray['module_desc']);
            $this->setActive($newArray['active']);
        }
    }

    public function toJSON(){
        return  str_replace('\\u0000', "", json_encode( (array) $this ));
    }
}

?>