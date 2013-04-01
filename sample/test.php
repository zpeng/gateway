<?php
include_once("../includes/bootstrap.php");
?>


<div class='content'>

    <?
    $userManager = new UserManager();


    echo     $userManager->getUserListAsJSON();
    ?>

</div>


<?= outputHTMLEnd() ?>
