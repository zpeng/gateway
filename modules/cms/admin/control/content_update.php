<?
require_once('../../../../includes/bootstrap.php');

$user_id = secureRequestParameter($_REQUEST["user_id"]);
$module_code = secureRequestParameter($_REQUEST["module_code"]);
$content_id = secureRequestParameter($_REQUEST["content_id"]);

$title = secureRequestParameter($_REQUEST["title"]);
$article_content = secureRequestParameter($_REQUEST["article_content"]);

$content = new Content();
$content->set_content_id($content_id);
$content->set_last_modify_by_user_id($user_id);
$content->set_title($title);
$content->set_article($article_content);
$content->update();

$url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=content_list"; // target of the redirect
$msg = "The article [" . $title . "] has been updated";
$url = $url . "&info=" . $msg;

header("Location: " . $url);

?>
