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

?>
<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title">Shipping Methods</span>
    </div>
    <div class="button_block">
        <a href="#" id="dialog_link">
            <img src="images/add_24.png" alt="New User" title="New User" border="0" />
        </a><br/>
        <b>New Shipping Methods</b>
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
                    <th ><h3>Shipping Type</h3></th>
                    <th ><h3>Shipping Cost</h3></th>
                    <th ><h3>Shipping Region</h3></th>
                    <th ><h3>Shipping Detail</h3></th>
                    <th width="100"><h3>Operations</h3></th>
                </tr>
            </thead>
            <tbody>

                <?
                $shippingManager = new ShippingManager();
                $shippingList = $shippingManager->getShippingList();

                if (sizeof($shippingList) > 0 ) {
                    foreach($shippingList as $shipping) {
                        echo "  <tr>
                                <td>".$shipping->get_shipping_id()."</td>
                                <td>".$shipping->get_shipping_type()."</td>
                                <td>".$shipping->get_shipping_cost()."</td>
                                <td>".$shipping->get_shipping_region()->get_shipping_region()."</td>
                                <td>".$shipping->get_shipping_detail()."</td>
                                <td>
                                <a href='process/admin_shipping_delete_process.php?shipping_id=".$shipping->get_shipping_id()."'
                                onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Delete this shipping method')."</a>
                                <a href='index.php?view=admin_shipping_update&shipping_id=".$shipping->get_shipping_id()."'
                                >".displayEditIcon(15,15,'Update shipping method')."</a>
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

    <div id="dialog" title="Create New Shipping Region">
        <br/>
        <form id="ShippingMethodCreationForm"  action='process/admin_shipping_add_process.php' method='post'
              onsubmit='return checkShippingMethodCreationForm(this)'>
            <table width="500" border="0" class="dialogTable" >
                <tr>
                    <td width="35%" align="right"><b>Shipping Type: </b></td>
                    <td>
                        <input name="shipping_type" id="shipping_type" style="width: 200px;" />
                    </td>
                </tr>
                <tr>
                    <td width="35%" align="right"><b>Shipping Cost: </b></td>
                    <td>
                        <input name="shipping_cost" id="shipping_cost" style="width: 200px;" />
                    </td>
                </tr>
                <tr>
                    <td width="35%" align="right"><b>Shipping Region: </b></td>
                    <td>
                        <? 
                        echo outputShippingRegionListAsDropdownList('shipping_region', 200);?>
                    </td>
                </tr>
                <tr>
                    <td width="35%" align="right" valign="top"><b>Shipping Detail: </b></td>
                    <td>
                        <textarea cols="30" rows="3" name="shipping_detail"
                                  id="shipping_detail" style="width: 200px;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="35%" align="right"></td>
                    <td></td>
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

