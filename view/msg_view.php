<?php

if($_REQUEST["info"]!="") {
    echo "<br/><h4 class='information'><img src='images/site/information.png'/>&nbsp;&nbsp;".$_REQUEST["info"]."</h4><br/>";
}

if($_REQUEST["warning"]!="") {
    echo "<br/><h4 class='warning'><img src='images/site/exclamation.png'/>&nbsp;&nbsp;".$_REQUEST["warning"]."</h4><br/>";
}

if($_REQUEST["error"]!="") {
    echo "<br/><h4 class='error'><img src='images/site/exclamation-red.png'/>&nbsp;&nbsp;".$_REQUEST["error"]."</h4><br/>";
}

?>
