<?
require_once('../../../includes/bootstrap.php');
use modules\cms\includes\classes\Content;


$user_id = secureRequestParameter($_REQUEST["user_id"]);
$content_id = secureRequestParameter($_REQUEST["content_id"]);
$title = secureRequestParameter($_REQUEST["title"]);
$article_content = $_REQUEST["article_content"];

$content = new Content();
$content->set_content_id($content_id);
$content->set_last_modify_by_user_id($user_id);
$content->set_title($title);
$content->set_article($article_content);
$content->update();


$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);

?>
