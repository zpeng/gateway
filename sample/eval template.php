<?php

$data["username"] = "Ziyang Peng";
$data["code"] = "Hello";

$template = file_get_contents("temp_content.tpl.php");
$template = template_parser($template);


$message = "";
ob_start();
eval($template);
$message = ob_get_contents();
ob_end_clean();


echo $message;


function template_parser($text) {
    $text = str_replace("\"", "'", $text); // replace " with '
    $text = str_replace("{{", "\".", $text);
    $text = str_replace("}}", ".\"", $text);
    $text = "print \"".$text;
    $text = $text."\";";
    return $text;
}
?>