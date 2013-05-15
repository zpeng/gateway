<?
require_once('../../../includes/bootstrap.php');
use modules\cms\includes\classes\Content;


$module_code = secureRequestParameter($_REQUEST["module_code"]);
$content_id = secureRequestParameter($_REQUEST["content_id"]);

$content = new Content();
$content->loadByID($content_id);
$content->delete();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=content_list"; // target of the redirect
$msg = "The article [" . $content->get_title() . "] has been deleted";
$url = $url . "&info=" . $msg;

header("Location: " . $url);

?>
