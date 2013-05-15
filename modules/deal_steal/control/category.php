<?php
require_once('../../../includes/bootstrap.php');
use modules\deal_steal\includes\classes\Category;
use modules\deal_steal\includes\classes\CategoryManager;

if (!empty($_REQUEST['operation'])) {
    if ($_REQUEST['operation'] == "create_category") {
        $_parent_id = $_REQUEST['parent_id'];
        $_category_name = $_REQUEST['name'];

        $category = new Category();
        $category->setParentId($_parent_id);
        $category->setName($_category_name);
        $category->insert();

        $response_array['status'] = '1';
        $response_array['id'] = $category->getId();
        header('Content-type: application/json');
        echo json_encode($response_array);

    } else if ($_REQUEST['operation'] == "remove_category") {
        $id = $_REQUEST['id'];
        $category = new Category();
        $category->setId($id);
        $category->delete();

        $response_array['status'] = '1';
        header('Content-type: application/json');
        echo json_encode($response_array);

    } else if ($_REQUEST['operation'] == "rename_category") {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $category = new Category();
        $category->setId($id);
        $category->setName($name);
        $category->update();

        $response_array['status'] = '1';
        header('Content-type: application/json');
        echo json_encode($response_array);

    } else if ($_REQUEST['operation'] == "move_category") {
        $id = $_REQUEST['id'];
        $parent_id = $_REQUEST['parent_id'];
        $category = new Category();
        $category->setId($id);
        $category->setParentId($parent_id);
        $category->move();

        $response_array['status'] = '1';
        $response_array['parent_id'] = $category->getParentId();
        header('Content-type: application/json');
        echo json_encode($response_array);

    } else if ($_REQUEST['operation'] == "load_category") {
        $id = $_REQUEST['id'];
        $categoryManager = new CategoryManager();
        $categoryManager->loadTree($id);
        header('Content-type: application/json');
        echo $categoryManager->toJSON();
    } else {
        //something is wrong
        $response_array['status'] = '0';
        header('Content-type: application/json');
        echo json_encode($response_array);
    }


} else {
    //something is wrong
    $response_array['status'] = '0';
    header('Content-type: application/json');
    echo json_encode($response_array);
}







?>