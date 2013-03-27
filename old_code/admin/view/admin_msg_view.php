<?php

if($_REQUEST["info"]!="") {
    echo "<div class='information'><img src='images/information.png'/><b class='information'>".$_REQUEST["info"]."</b></div>";
}

if($_REQUEST["warning"]!="") {
    echo "<div class='warning'><img src='images/exclamation.png'/><b class='warning'>".$_REQUEST["warning"]."</b></div>";
}

if($_REQUEST["error"]!="") {
    echo "<div class='error'><img src='images/exclamation-red.png'/><b class='error'>".$_REQUEST["error"]."</b></div>";
}

?>
