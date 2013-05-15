<?
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Template;

$template_id = secureRequestParameter($_REQUEST["template_id"]);
$template_title = secureRequestParameter($_REQUEST["template_title"]);
$template_content = secureRequestParameter($_REQUEST["template_content"]);

$template = new Template();
$template->setId($template_id);
$template->setTitle($template_title);
$template->setContent($template_content);
$template->update();

$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);

?>
