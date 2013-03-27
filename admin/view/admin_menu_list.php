<script type="text/javascript">
    $(function(){
        // Tabs
        $("#Tabs").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
        $("#Tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');
    });
</script>

<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title"> Site Menus</span>
    </div>
    <div class="button_block">
        <a href="index.php?view=admin_menu_add" >
            <img src="images/add_24.png" alt="New Language" title="New Language" border="0" />
        </a><br/>
        <b>New Menu</b>
    </div>
</fieldset>
<?
include_once 'admin_msg_view.php';
?>

<fieldset class="content_fieldset">
    <br/>
    <?
    require_once('../included/class_loader.php') ;
    ?>
    <div id="Tabs" style="min-width:850px;font-size:100%; margin: 10px; ">
        <ul>
            <li><a href="#top_menu"><span>Primary Menu</span></a></li>
            <li><a href="#buttom_menu"><span>Secondary Menu</span></a></li>
        </ul>
        <div id="top_menu">
            <br/>
            <div id="tablewrapper"  style="width:100%; min-width:850px;">
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
                <table  cellpadding="0" cellspacing="0" border="0" id="top_menu_table" class="tinytable">
                    <thead >
                        <tr >
                            <th class="nosort" ><h3> ID</h3></th>
                            <th class="nosort" ><h3>Menu Type</h3></th>
                            <th class="nosort" ><h3>Menu Name</h3></th>
                            <th class="nosort" ><h3>Order</h3></th>
                            <th class="nosort" ><h3>Link</h3></th>
                            <th class="nosort" width="100"><h3>Operations</h3></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?

                        $menu_type = new MenuType();
                        // this is top menu
                        $menu_type->load(1);
                        $menuList = $menu_type->getMenuItemListByMenuType();

                        if (sizeof($menuList) > 0 ) {
                            foreach($menuList as $menu) {
                                $menuType = new MenuType();
                                $menuType = $menu->get_menu_type();
                                echo "
                            <tr>
                            <td>".$menu->get_menu_id()."</td>
                            <td>".$menuType->get_menu_type_name()."</td>
                            <td>".$menu->getDefaultMenuDescription()->get_menu_name()."</td>
                            <td>".$menu->get_menu_order()."</td>
                            <td>".$menu->get_menu_link()."</td>
                            <td width='90px'>
                            <a href='process/admin_menu_delete_process.php?menu_id=".$menu->get_menu_id()."'
                            onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Update this menu item')."</a>
                            <a href='index.php?view=admin_menu_update&menu_id=".$menu->get_menu_id()."' 
                            >".displayEditIcon(15,15,'Update this menu item')."</a>
                            </td>
                            </tr> ";

                                //for the sub
                                $subMenuList = $menu->getSubMenuItemList();
                                if (sizeof($subMenuList) > 0 ) {
                                    foreach($subMenuList as $subMenu) {
                                        $menuType = new MenuType();
                                        $menuType = $subMenu->get_menu_type();

                                        echo "
                <tr>
                <td>".$subMenu->get_menu_id()."</td>
                <td>".$menuType->get_menu_type_name()."</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ".$subMenu->getDefaultMenuDescription()->get_menu_name()."</td>
                <td>".$subMenu->get_menu_order()."</td>
                <td>".$subMenu->get_menu_link()."</td>
                <td width='90px'>
                <a href='process/admin_menu_delete_process.php?menu_id=".$subMenu->get_menu_id()."'
                onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Delete this menu item')."</a>
                <a href='index.php?view=admin_menu_update&menu_id=".$subMenu->get_menu_id()."' 
                >".displayEditIcon(15,15,'Update this menu item')."</a>
                </td>
                </tr> ";
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <div id="tablefooter" >
                    <table border="0" width="750">
                        <tr>
                            <td width="50%">
                                <div id="tablenav">

                                    <img src="images/sorttable/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                                    <img src="images/sorttable/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                                    <img src="images/sorttable/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                                    <img src="images/sorttable/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                                    &nbsp;&nbsp;
                                    <select id="pagedropdown"></select>&nbsp;&nbsp;
                                    <a href="javascript:sorter.showall()">view all</a>
                                </div>
                            </td>
                            <td>
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
                            </td>
                        </tr>
                    </table>
                </div>


            </div>
            <script type="text/javascript" src="js/sortedTable.js"></script>
            <script type="text/javascript">
                var sorter = new TINY.table.sorter('sorter','top_menu_table',{
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
                    columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
                    init:true
                });
            </script>
            <br/>
        </div>


        <div id="buttom_menu">
            <br/>
            <div id="tablewrapper" style="width:100%; min-width:850px;">
                <div id="tableheader">
                    <div class="search">
                        <select id="columns_b" onchange="sorter_b.search('query_b')"></select>
                        <input type="text" id="query_b" onkeyup="sorter_b.search('query_b')" />
                    </div>
                    <span class="details">
                        <div>Records <span id="startrecord_b"></span>-<span id="endrecord_b"></span> of <span id="totalrecords_b"></span></div>
                        <div><a href="javascript:sorter_b.reset()">reset</a></div>
                    </span>
                </div>
                <table  cellpadding="0" cellspacing="0" border="0" id="buttom_menu_table" class="tinytable">
                    <thead >
                        <tr >
                            <th class="nosort" ><h3> ID</h3></th>
                            <th class="nosort" ><h3>Menu Type</h3></th>
                            <th class="nosort" ><h3>Menu Name</h3></th>
                            <th class="nosort" ><h3>Order</h3></th>
                            <th class="nosort" ><h3>Link</h3></th>
                            <th class="nosort" width="100"><h3>Operations</h3></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?

                        $menu_type = new MenuType();
                        // this is buttom menu
                        $menu_type->load(2);
                        $menuList = $menu_type->getMenuItemListByMenuType();

                        if (sizeof($menuList) > 0 ) {
                            foreach($menuList as $menu) {
                                $menuType = new MenuType();
                                $menuType = $menu->get_menu_type();
                                echo "
                            <tr>
                            <td>".$menu->get_menu_id()."</td>
                            <td>".$menuType->get_menu_type_name()."</td>
                            <td>".$menu->getDefaultMenuDescription()->get_menu_name()."</td>
                            <td>".$menu->get_menu_order()."</td>
                            <td>".$menu->get_menu_link()."</td>
                            <td width='90px'>
                            <a href='process/admin_menu_delete_process.php?menu_id=".$menu->get_menu_id()."'
                            onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Update this menu item')."</a>
                            <a href='index.php?view=admin_menu_update&menu_id=".$menu->get_menu_id()."' 
                            >".displayEditIcon(15,15,'Update this menu item')."</a>
                            </td>
                            </tr> ";

                                //for the sub
                                $subMenuList = $menu->getSubMenuItemList();
                                if (sizeof($subMenuList) > 0 ) {
                                    foreach($subMenuList as $subMenu) {
                                        $menuType = new MenuType();
                                        $menuType = $subMenu->get_menu_type();

                                        echo "
                <tr>
                <td>".$subMenu->get_menu_id()."</td>
                <td>".$menuType->get_menu_type_name()."</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ".$subMenu->getDefaultMenuDescription()->get_menu_name()."</td>
                <td>".$subMenu->get_menu_order()."</td>
                <td>".$subMenu->get_menu_link()."</td>
                <td width='90px'>
                <a href='process/admin_menu_delete_process.php?menu_id=".$subMenu->get_menu_id()."'
                onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Delete this menu item')."</a>
                <a href='index.php?view=admin_menu_update&menu_id=".$subMenu->get_menu_id()."' 
                >".displayEditIcon(15,15,'Update this menu item')."</a>
                </td>
                </tr> ";
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <div id="tablefooter" >
                    <table border="0" width="750">
                        <tr>
                            <td width="50%">
                                <div id="tablenav_b">

                                    <img src="images/sorttable/first.gif" width="16" height="16" alt="First Page" onclick="sorter_b.move(-1,true)" />
                                    <img src="images/sorttable/previous.gif" width="16" height="16" alt="First Page" onclick="sorter_b.move(-1)" />
                                    <img src="images/sorttable/next.gif" width="16" height="16" alt="First Page" onclick="sorter_b.move(1)" />
                                    <img src="images/sorttable/last.gif" width="16" height="16" alt="Last Page" onclick="sorter_b.move(1,true)" />
                                    &nbsp;&nbsp;
                                    <select id="pagedropdown_b"></select>&nbsp;&nbsp;
                                    <a href="javascript:sorter_b.showall()">view all</a>
                                </div>
                            </td>
                            <td>
                                <div id="tablelocation">
                                    <div>
                                        <select onchange="sorter_b.size(this.value)">
                                            <option value="5">5</option>
                                            <option value="10" selected="selected">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <span>Entries Per Page</span>
                                    </div>
                                    <div class="page">Page <span id="currentpage_b"></span> of <span id="totalpages_b"></span></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <script type="text/javascript">
                var sorter_b = new TINY.table.sorter('sorter_b','buttom_menu_table',{
                    headclass:'head',
                    ascclass:'asc',
                    descclass:'desc',
                    evenclass:'evenrow',
                    oddclass:'oddrow',
                    evenselclass:'evenselected',
                    oddselclass:'oddselected',
                    paginate:true,
                    size:10,
                    colddid:'columns_b',
                    currentid:'currentpage_b',
                    totalid:'totalpages_b',
                    startingrecid:'startrecord_b',
                    endingrecid:'endrecord_b',
                    totalrecid:'totalrecords_b',
                    hoverid:'selectedrow_b',
                    pageddid:'pagedropdown_b',
                    navid:'tablenav_b',
                    columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
                    init:true
                });
            </script>
            <br/>
        </div>
    </div>

</fieldset>


