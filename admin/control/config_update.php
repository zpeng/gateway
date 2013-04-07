<?
require_once('../../includes/bootstrap.php');


$config_id = secureRequestParameter($_REQUEST["config_id"]);
$config_key = secureRequestParameter($_REQUEST["config_key"]);
$config_value = secureRequestParameter($_REQUEST["config_value"]);

$module_code = secureRequestParameter($_REQUEST["module_code"]);

$config = new Configuration();
$config->set_configuration_id($config_id);
$config->set_configuration_value($config_value);
$config->update();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=config_list"; // target of the redirect
$msg = "The value of configuration key [" . $config_key . "] has been update";
$url = $url . "&info=" . $msg;
echo $url;

header("Location: " . $url);

?>
