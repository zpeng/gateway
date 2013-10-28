<?php
if(isset($_REQUEST["info"])) {
    echo "<span class='info'>".$_REQUEST["info"]."</span>";
}
if(isset($_REQUEST["warning"])) {
    echo "<span class='warning'>".$_REQUEST["warning"]."</span>";
}
if(isset($_REQUEST["error"])) {
    echo "<span class='error'>".$_REQUEST["error"]."</span>";
}
?>
