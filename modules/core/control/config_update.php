<?
require_once('../../../includes/bootstrap.php');
use modules\core\includes\classes\Configuration;

$config_id = secureRequestParameter($_REQUEST["config_id"]);
$config_value = secureRequestParameter($_REQUEST["config_value"]);

$config = new Configuration();
$config->set_configuration_id($config_id);
$config->set_configuration_value($config_value);
$config->update();

$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);
?>
