<?php
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\TagManager;

$tagManager = new TagManager();

if (!empty($_REQUEST['operation'])) {
    if ($_REQUEST['operation'] == "load_tags") {

        header('Content-type: application/json');
        echo json_encode($tagManager->loadAllTags());
    } else if ($_REQUEST['operation'] == "add_tag") {
        $tag_value = secureRequestParameter($_REQUEST['tag_value']);
        $tag = new Tag();
        $tag->setTagValue($tag_value);
        $tag->insert();

        header('Content-type: application/json');
        echo json_encode($tagManager->loadAllTags());
    }else if ($_REQUEST['operation'] == "delete_tag") {
        $tag_value = secureRequestParameter($_REQUEST['tag_value']);
        $tag = new Tag();
        $tag->loadByValue($tag_value);
        $tag->delete();

        header('Content-type: application/json');
        echo json_encode($tagManager->loadAllTags());
    }
}

?>