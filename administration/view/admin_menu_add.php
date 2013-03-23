<script>
    var xmlHttp;

    function showMenuParentDropdownList(str)
    {

        xmlHttp=GetXmlHttpObject();
        if (xmlHttp==null)
        {
            alert ("Browser does not support HTTP Request");
            return;
        }
        var url = "view/ajax_getMenuParentDropdownListFilterByMenuTypeID.php" ;


        url=url+"?menu_type_id="+str;
        url=url+"&sid="+Math.random();

        xmlHttp.onreadystatechange=stateChanged_1;
        xmlHttp.open("GET",url,true);
        xmlHttp.send(null);

    }

    function showLinkTypeDropdownList(str)
    {

        xmlHttp=GetXmlHttpObject();
        if (xmlHttp==null)
        {
            alert ("Browser does not support HTTP Request");
            return;
        }
        var url = "view/ajax_getContentDropdownListFilterByLinkTypeID.php" ;


        url=url+"?link_type_id="+str;
        url=url+"&sid="+Math.random();

        xmlHttp.onreadystatechange=stateChanged_2;
        xmlHttp.open("GET",url,true);
        xmlHttp.send(null);

    }

    function stateChanged_1()
    {
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
        {
            document.getElementById("menuParentField").innerHTML=xmlHttp.responseText;
        }
    }

    function stateChanged_2()
    {
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
        {
            document.getElementById("contentField").innerHTML=xmlHttp.responseText;
        }
    }


    function GetXmlHttpObject()
    {
        var xmlHttp=null;
        try
        {
            // Firefox, Opera 8.0+, Safari
            xmlHttp=new XMLHttpRequest();
        }
        catch (e)
        {
            //Internet Explorer
            try
            {
                xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e)
            {
                xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        return xmlHttp;
    }
</script>

<?
require_once("../included/class_loader.php") ;

$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();

?>

<form action='process/admin_menu_add_process.php' method='post' onsubmit='return checkMenuCreationForm(this)'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Create Menu</span>
        </div>
        <div class="button_block">
            <a>
                <input name='Save' type='image'  value='Save' title="Save" src="images/save_24.png"/>
            </a><br/>
            <b>Save</b>
        </div>
    </fieldset>
    <?
    include_once 'admin_msg_view.php';
    ?>
    <fieldset class="content_fieldset">
        <br/>

        <div>
            <table width="800" border="0" style="font:100%;" cellpadding="3"  >
                <tr>
                    <td width="150" align="right" ><b>Menu Type:</b></td>
                    <td align='left'><? echo outputMenuTypeListAsDropdownListAjax("menu_type_id","250"); ?></td>
                </tr>
            </table>
        </div>

        <div id='menuParentField'>

        </div>

        <div id="menu_name">
            <table width="800" border="0" style="font:100%;" cellpadding="3"  >

                <?
                if (sizeof($languageList) > 0) {
                    $language = new Language();
                    $count=0;
                    foreach($languageList as $language) {
                        echo"
                                <tr>
                                    <td width='150' align='right'><b>Menu Name:</b></td>
                                    <td align='left'><input name='menu_name".$count."' style='width: 230px;' />".$language->get_language_icon_as_image()."</td>
                                </tr>";
                        $count++;
                    }
                }
                ?>

                <tr>
                    <td width="150" align="right" ><b>Display Order:</b></td>
                    <td align='left'><input name="menu_order" style="width: 250px;" value='1' /></td>
                </tr>



                <tr>
                    <td align="right"><b>Link Type:</b></td>
                    <td align='left'><? echo  outputLinkTypeListAsDropdownListAjax("link_type_id","250"); ?></td>
                </tr>
            </table>

        </div>

        <div id='contentField'>

        </div>

    </fieldset>
</form>       
