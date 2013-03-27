<div class="left_box">
    <h6 style="margin-bottom:1px;">Category</h6>

    <ul id="navmenu-v" class="naymenu-v" >
        <?
        $categoryManager = new CategoryManager();
        $categoryList = $categoryManager->getTopCategoryList();

        if (sizeof($categoryList) > 0) {
            foreach($categoryList as $category) {
                echo "<li><a href='index.php?view=product_by_category&category_id=".$category->get_category_id()."'>
                        ".$category->get_category_name()."</a>";
                if ($category->get_category_children_list() != null) {
                    if (sizeof($category->get_category_children_list()) > 0) {
                        echo outputCategoryAsLinkList($category->get_category_children_list());
                    }
                }
                echo "</li>";
            }
        }
        ?>
    </ul>
</div>
