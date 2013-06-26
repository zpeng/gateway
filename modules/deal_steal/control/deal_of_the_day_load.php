<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\DealManager;

$dealManager = new DealManager();
echo json_encode($dealManager->getDealOfTheDayDataSource());

?>
