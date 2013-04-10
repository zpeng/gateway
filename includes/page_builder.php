<?php

function outputHTMLStartBackend($page_title = "", $deps)
{
    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html><head>";

    echo "<title>" . $page_title . "</title>";

    echo output_js_dependencies($deps["js"]["backend"]);
    echo output_css_dependencies($deps["css"]["backend"]);

    echo "</head><body>";
}

function outputHTMLStartFrontend($deps, $configManager)
{
    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html><head>";

    echo "<title>" . $configManager->getValueByKey("shop_name") . "</title>";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
    echo "<meta name=\"description\" content=\"" . $configManager->getValueByKey("meta_description") . "\" />";
    echo "<meta name=\"keywords\" content=\"" . $configManager->getValueByKey("meta_keywords") . "\" />";

    echo output_js_dependencies($deps["js"]["frontend"]);
    echo output_css_dependencies($deps["css"]["frontend"]);

    echo "</head><body>";
}

function outputHTMLEnd()
{
    echo "</body></html>";
}

function output_js_dependencies($js_deps)
{
    foreach ($js_deps as $js) {
        if (is_array($js) && sizeof($js) > 0) {
            output_js_dependencies($js);
        } else {
            echo "<script type=\"text/javascript\" src=\"" . SERVER_URL . $js . "\"></script>";
        }
    }
}

function output_css_dependencies($css_deps)
{
    foreach ($css_deps as $css) {
        if (is_array($css) && sizeof($css) > 0) {
            output_css_dependencies($css);
        } else {
            echo  "<link rel=\"stylesheet\" type=\"text/css\" href=" . SERVER_URL . $css . " />";
        }
    }
}

?>