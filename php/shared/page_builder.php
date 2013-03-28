<?php

function outputHTMLStart($page_title = "", $JS_LIST, $CSS_LIST)
{
    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html><head>";

    echo output_page_title($page_title);

    echo output_js_dependencies($JS_LIST);
    echo output_css_dependencies($CSS_LIST);


    echo "</head><body>";
}

function outputHTMLEnd()
{
    echo "</body></html>";
}


function output_meta_data()
{
}

function output_page_title($page_title)
{
    echo "<title>" . $page_title . "</title>";
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