<?
require_once('../../../../includes/bootstrap.php');
use modules\cms\includes\classes\Content;


$user_id = secureRequestParameter($_REQUEST["user_id"]);
$module_code = secureRequestParameter($_REQUEST["module_code"]);

$title = secureRequestParameter($_REQUEST["title"]);
$article_content = secureRequestParameter($_REQUEST["article_content"]);

$content = new Content();
$content->set_author_id($user_id);
$content->set_title($title);
$content->set_article($article_content);
$content->insert();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=content_list"; // target of the redirect
$msg = "New article [" . $title . "] has been created";
$url = $url . "&info=" . $msg;

header("Location: " . $url);

?>
