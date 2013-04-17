<h1 class="content_title">Deal Category</h1>
<div id="notification"></div>
<div id="content">
    <?
    $categoryManager = new CategoryManager();
    $categoryManager->loadTree();

    echo $categoryManager->toJSON();

    ?>


</div>
<script>

</script>