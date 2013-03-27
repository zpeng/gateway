<script type="text/javascript" >
    function getQuerystring(key, default_)
    {
        if (default_==null) default_="";
        key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
        var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
        var qs = regex.exec(window.location.href);
        if(qs == null)
            return default_;
        else
            return qs[1];
    }

    var tab_id = getQuerystring('tab_id','tabs-1');

    $(function(){
        // Tabs
        $("#Tabs").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
        $("#Tabs").tabs('select', '#'+tab_id);
        $("#Tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');
    });
</script>

<style type="text/css">

    /* Vertical Tabs
    ----------------------------------*/
    .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
    .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0;  }
    .ui-tabs-vertical .ui-tabs-nav li a { display:block;  }
    .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
    .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 40em; }
</style>


<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title"> Configuration</span>
    </div>
    <div class="button_block">
    </div>
</fieldset>
<?
include_once 'admin_msg_view.php';
?>
<fieldset class="content_fieldset">
    <?
    require_once("../included/class_loader.php") ;
    require_once('../included/html_functions.php');

    $configManager = new ConfigurationManager();
    $listOfConfigurationGroup = $configManager->getConfigurationGroupList();

    ?>
    <div id="Tabs" style="width:100%; min-width:1000px;font-size:100%; margin: 0px; ">
        <ul>
            <?
            if (sizeof($listOfConfigurationGroup)>0) {
                foreach($listOfConfigurationGroup as $configGroup) {
                    echo "<li style='font-size:80%'><a href='#Tabs-".$configGroup->get_configuration_group_id()."'>
                            ".$configGroup->get_configuration_group_title()."</a></li>";
                }
            }
            ?>
        </ul>

        <?

        if (sizeof($listOfConfigurationGroup)>0) {
            foreach($listOfConfigurationGroup as $configGroup) {
                $configEntityList = $configGroup->get_configuration_entity_list();
                $field = "";
                $field = $field."<div id='Tabs-".$configGroup->get_configuration_group_id()."' style='float: left'>";
                $field = $field."<form id='configurationUpdateForm'  action='process/admin_configuration_update_process.php' method='post'>";
                $field = $field."<table width='700' border='0' class='data_table' ><tr><td align='right'>";
                $field = $field."</td><td align='left'><input name='Save' type='image'  value='Save' title='Save' src='images/save_24.png' /></td></tr>";
                $field = $field."<input name='tab_id' id='tab_id' type='hidden' value='Tabs-".$configGroup->get_configuration_group_id()."'/>";
                $field = $field."<input name='config_group_id' id='config_group_id' type='hidden' value='".$configGroup->get_configuration_group_id()."'/>";

                if(sizeof($configEntityList)>0) {
                    foreach($configEntityList as $configEntity) {
                        $field = $field."<tr><td width='150' align='right' valign='top'><b>".$configEntity->get_configuration_title().": </b></td>";
                        $field = $field."<td align='left'>".$configEntity->outputConfigEntityAsHTML()."</td></tr>";
                    }
                }


                $field = $field."<tr><td></td><td></td></tr><tr><td></td><td></td></tr></form></table></div>";
                echo $field;
            }
        }

        ?>





    </div>


</fieldset>
