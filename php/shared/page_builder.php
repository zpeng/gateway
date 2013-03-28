<?php

function outputHTMLStartBackend($page_title = "", $JS_LIST, $CSS_LIST)
{
    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html><head>";

    echo "<title>" . $page_title . "</title>";

    echo output_js_dependencies($JS_LIST);
    echo output_css_dependencies($CSS_LIST);


    echo "</head><body>";
}


function outputHTMLStartFrontend($JS_LIST, $CSS_LIST, $s_configManager)
{
    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html><head>";

    echo "<title>" . $s_configManager->getValueByKey("shop_name") . "</title>";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
    echo "<meta name=\"description\" content=\"" . $s_configManager->getValueByKey("meta_description") ."\" />";
    echo "<meta name=\"keywords\" content=\"" . $s_configManager->getValueByKey("meta_keywords") . "\" />";

    echo output_js_dependencies($JS_LIST);
    echo output_css_dependencies($CSS_LIST);


    echo "</head><body>";
}

function outputHTMLEnd()
{
    echo "</body></html>";
}


function output_js_dependencies($JS_LIST)
{
    foreach ($JS_LIST as $js) {
        echo "<script type=\"text/javascript\" src=\"" . SERVER_URL . $js . "\"></script>";
    }
}


function output_css_dependencies($CSS_LIST)
{
    foreach ($CSS_LIST as $css) {
        echo  "<link rel=\"stylesheet\" type=\"text/css\" href=" . SERVER_URL . $css . " />";
    }
}

?>