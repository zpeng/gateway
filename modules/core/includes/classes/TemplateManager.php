<?php
namespace  modules\core\includes\classes;

use Exception;

class TemplateManager
{
    private function template_parser($text)
    {
        $text = str_replace("\"", "'", $text); // replace " with '
        $text = str_replace("{{", "\".", $text);
        $text = str_replace("}}", ".\"", $text);
        $text = "print \"" . $text;
        $text = $text . "\";";
        return $text;
    }

    public function getProcessedContentFromTemplate($template_content, $data = array())
    {
        try {
            ob_start();
            eval($this->template_parser($template_content));
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        } catch (Exception $e) {
            throw new Exception("Unable to process the template due to the following error \n\n\n" . $e->getMessage() . "\n");
        }
    }
}
?>
