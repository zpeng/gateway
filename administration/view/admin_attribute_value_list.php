<script type="text/javascript" >
    $(function(){
        // Dialog
        $('#dialog').dialog({
            autoOpen: false, modal: true,
            width: 550,
            buttons: {
                "Cancel": function() {
                    $(this).dialog("close");
                }
            }
        });

        // Dialog Link
        $('#dialog_link').click(function(){
            $('#dialog').dialog('open');
            return false;
        });
    });
</script>
<?
require_once("../included/class_loader.php") ;
require_once("../included/html_functions.php") ;
$attribute_id = secureRequestParameter($_REQUEST["attribute_id"]);
$attribute = new Attribute();
$attribute->load($attribute_id);
?>
<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title">Attribute [ <a href='index.php?view=admin_attribute_list&attribute_id=<?=$attribute_id?>'><?=$attribute->get_attribute_name()?></a> ] Value List</span>
    </div>
    <div class="button_block">
        <a href="#" id="dialog_link">
            <img src="images/add_24.png" alt="New User" title="New User" border="0"/>
        </a><br/>
        <b>New Attribute Value</b>
    </div>
    <div class="button_block">
        <a href="index.php?view=admin_attribute_list">
            <img src="images/go_back_24.png" />
            <br/>
            <b>Go Back</b>
        </a>
    </div>
</fieldset>
<?
include_once 'admin_msg_view.php';
?>
<fieldset class="content_fieldset">
    <br/>
    <div id="tablewrapper">
        <div id="tableheader">
            <div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
                <div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
                <div><a href="javascript:sorter.reset()">reset</a></div>
            </span>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead >
                <tr>
                    <th width="80"><h3>&nbsp;ID</h3></th>
                    <th ><h3>Attribute Value</h3></th>
                    <th width="100"><h3>Operations</h3></th>
                </tr>
            </thead>
            <tbody>

                <?
                $attributeValueList = $attribute->get_attribute_value_list();

                if (sizeof($attributeValueList) > 0 ) {
                    foreach($attributeValueList as $attributeValue) {
                        echo "  <tr>
                                <td>".$attributeValue->get_attribute_value_id()."</td>
                                <td>".$attributeValue->get_attribute_value()."</td>
                                <td>
 <a href='process/admin_attribute_value_delete_process.php?attribute_value_id=".$attributeValue->get_attribute_value_id()."&attribute_id=".$attribute_id."'
                                onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Delete this attribute value')."</a>
                                <a href='index.php?view=admin_attribute_value_update&attribute_value_id=".$attributeValue->get_attribute_value_id()."&attribute_id=".$attribute_id."' 
                                >".displayEditIcon(15,15,'Update attribute value')."</a>
                                </td>
                                </tr> ";
                    }
                }
                ?>
            </tbody>&nbsp;
        </table>

        <div id="tablefooter">
            <div id="tablenav">
                <div>
                    <img src="images/sorttable/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/sorttable/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/sorttable/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/sorttable/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                    <select id="pagedropdown"></select>
                </div>
                <div>
                    <a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
            <div id="tablelocation">
                <div>
                    <select onchange="sorter.size(this.value)">
                        <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="js/sortedTable.js"></script>
    <script type="text/javascript">
        var sorter = new TINY.table.sorter('sorter','table',{
            headclass:'head',
            ascclass:'asc',
            descclass:'desc',
            evenclass:'evenrow',
            oddclass:'oddrow',
            evenselclass:'evenselected',
            oddselclass:'oddselected',
            paginate:true,
            size:10,
            colddid:'columns',
            currentid:'currentpage',
            totalid:'totalpages',
            startingrecid:'startrecord',
            endingrecid:'endrecord',
            totalrecid:'totalrecords',
            hoverid:'selectedrow',
            pageddid:'pagedropdown',
            navid:'tablenav',
            sortcolumn:0,
            sortdir:0,
            columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
            init:true
        });
    </script>

    <div id="dialog" title="Create New Attribute Value">
        <br/>
        <form id="productAttributeValueCreationForm"  action='process/admin_attribute_value_add_process.php' method='post'
              onsubmit='return checkProductAttributeValueCreationForm(this)'>
            <table width="500" border="0" class="dialogTable" >
                <tr>
                    <td width="150" align="right"><b>Attribute Name: </b></td>
                    <td>
                        <input name="attribute_id" id="attribute_id" style="width: 200px;" type="hidden"
                               value="<?=$attribute_id?>"/>
                        <input name="attribute_name" id="attribute_name" style="width: 200px;" readonly="true"
                               value="<?=$attribute->get_attribute_name()?>"/>
                    </td>
                </tr>
                <tr>
                    <td width="150" align="right"><b>Attribute Value: </b></td>
                    <td><input name="attribute_value" id="attribute_value" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input name='Add' type='submit'  value='Create' class="ui-state-default ui-corner-all"/>
                        <input name='Reset' type='reset' value='Reset' class="ui-state-default ui-corner-all"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <br/>
</fieldset>

