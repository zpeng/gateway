<?php

use modules\core\includes\classes\User;
use modules\core\includes\classes\ConfigurationManager;

class UserSession
{
    public $userName;
    public $userID;
    public $user_subscribe_module_code_name_map =[];
    public $configManager;


    static public function cast(UserSession $object)
    {
        return $object;
    }

    function __construct($userName)
    {
        $this->load($userName);
    }

    private function load($userName)
    {
        $user = new User();
        $user->loadByEmail($userName);
        $this->userName = $userName;
        $this->userID = $user->get_user_id();
        $this->user_subscribe_module_code_name_map = $user->user_subscribe_module_code_name_map;

        $configManager = new ConfigurationManager();
        $configManager->loadByUserID($this->userID);
        $this->configManager = $configManager;
    }

    public function toJSON(){
        return  str_replace('\\u0000', "", json_encode( (array) $this ));
    }
}
?>
