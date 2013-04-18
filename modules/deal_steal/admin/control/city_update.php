<?
require_once('../../../../includes/bootstrap.php');


$city_id = secureRequestParameter($_REQUEST["city_id"]);
$city_name = secureRequestParameter($_REQUEST["city_name"]);

$city = new City();
$city->setCityId($city_id);
$city->setCityName($city_name);
$city->update();

$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);
?>
