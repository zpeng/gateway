<?php
class Module {
    public $module_id;
    public $module_name;
    public $module_code;
    public $module_desc;
    public $module_archived;

    public function get_module_id() {
        return $this->module_id;
    }

    public function set_module_id($_module_id) {
        $this->module_id = $_module_id;
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

    public function get_module_archived() {
        return $this->module_archived;
    }

    public function set_module_archived($_module_archived) {
        $this->module_archived = $_module_archived;
    }

    public function loadByModuleCode($_module_code) {
        $link = getConnection();
        $query = " select module_id,
                        module_name,
                        module_code,
                        module_desc,
                        module_archived
                from    core_module
                where   module_archived =   'N'
                and     module_code =  '".$_module_code."'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_module_id($newArray['module_id']);
            $this->set_module_name($newArray['module_name']);
            $this->set_module_code($newArray['module_code']);
            $this->set_module_desc($newArray['module_desc']);
            $this->set_module_archived($newArray['module_archived']);
        }
    }

    public function loadByModuleID($_module_id) {
        $link = getConnection();
        $query = " select module_id,
                        module_name,
                        module_code,
                        module_desc,
                        module_archived
                from    core_module
                where   module_archived =   'N'
                and     module_id =  ".$_module_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_module_id($newArray['module_id']);
            $this->set_module_name($newArray['module_name']);
            $this->set_module_code($newArray['module_code']);
            $this->set_module_desc($newArray['module_desc']);
            $this->set_module_archived($newArray['module_archived']);
        }
    }


    public function toJSON(){
        return  str_replace('\\u0000', "", json_encode( (array) $this ));
    }
}

?>