<?php
include_once("../includes/bootstrap.php");
?>


<div class='content'>

    <?
    echo date("Y-m-1", strtotime( date("Y-m-t") ));
    ?>

</div>


<?= outputHTMLEnd() ?>
