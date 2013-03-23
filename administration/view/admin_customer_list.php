<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title">Customers</span>
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
                    <th width="50"><h3>ID</h3></th>
                    <th width="150"><h3>Email</h3></th>
                    <th width="100"><h3>Full Name</h3></th>
                    <th width="80"><h3>Tel</h3></th>
                    <th width="80"><h3>Mobile</h3></th>
                    <th width="100"><h3>Newsletter Subscribe</h3></th>
                    <th width="100"><h3>Register Date</h3></th>
                    <th width="100"><h3>Last Visit</h3></th>
                    <th width="100"><h3>Last Edit</h3></th>
                    <th width="50"><h3>Operations</h3></th>
                </tr>
            </thead>
            <tbody>
                <?
                require_once("../included/class_loader.php") ;
                require_once("../included/html_functions.php") ;

                $customerManager = new CustomerManager();
                $customerList = $customerManager->getCustomerList();

                if (sizeof($customerList) > 0 ) {
                    foreach($customerList as $customer) {
                        echo "  <tr>
                                <td>".$customer->get_customer_id()."</td>
                                <td>".$customer->get_email()."</td>
                                <td>".$customer->get_full_name()."</td>
                                <td>".$customer->get_telephone()."</td>
                                <td>".$customer->get_mobile()."</td>
                                <td>".$customer->get_newsletter_as_icon()."</td>
                                <td>".$customer->get_register_date()."</td>
                                <td>".$customer->get_last_visit_time()."</td>
                                <td>".$customer->get_last_edit_time()."</td>
                                <td>
                                <a href='index.php?view=admin_customer_update&customer_id=".$customer->get_customer_id()."' 
                                >".displayEditIcon(15,15,'View/Edit Customer Detail')."</a>
                                </td>
                                </tr> ";
                    }
                }
                ?>
            </tbody>
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
            size:20,
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

</fieldset>

