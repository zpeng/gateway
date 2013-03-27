<?php

require_once('../../included/class_loader.php');
require_once('../../included/common_functions.php');

$url = "../index.php?view=admin_configuration"; // target of the redirect
$tab_id = secureRequestParameter($_REQUEST["tab_id"]);

$configGroupID = secureRequestParameter($_REQUEST["config_group_id"]);
$configGroup = new ConfigurationGroup();
$configGroup->load($configGroupID);

$configEntityList = $configGroup->get_configuration_entity_list();
if(sizeof($configEntityList)>0) {
    foreach($configEntityList as $configEntity) {
        $configGroup->setConfigurationKeyAndValue($configEntity->get_configuration_key(), secureRequestParameter($_REQUEST[$configEntity->get_configuration_key()]));
    }
}

//update the configuration from database
$configGroup->updateConfigurationEntityList();

//reload the configuration and assign to session
if (session_id() == "") {session_start();}
$s_configManager = new ConfigurationManager();
unset ($_SESSION['$configManager']);
$_SESSION['configuration'] = serialize($s_configManager);


//redirect
$url=$url."&tab_id=".$tab_id;
$msg = "The configuration [".$configGroup->get_configuration_group_title()."] has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );
?>

