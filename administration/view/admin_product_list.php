<script type="text/javascript" >
    $(function(){
        // Dialog
        $('#dialog_new_product').dialog({
            autoOpen: false, modal: true,
            width: 550,
            buttons: {
                "Cancel": function() {
                    $(this).dialog("close");
                }
            }
        });

        // Dialog Link
        $('#dialog_link_new_product').click(function(){
            $('#dialog_new_product').dialog('open');
            return false;
        });

        // Dialog
        $('#dialog_search_product').dialog({
            autoOpen: false, modal: true,
            width: 550,
            buttons: {
                "Cancel": function() {
                    $(this).dialog("close");
                }
            }
        });

        // Dialog Link
        $('#dialog_link_search_product').click(function(){
            $('#dialog_search_product').dialog('open');
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#date_available").datepicker({ dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: "-80:+0"});
    });
</script>
<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title">Products</span>
    </div>
    <div class="button_block">
        <a href="#" id="dialog_link_new_product">
            <img src="images/add_24.png" alt="New User" title="New User" border="0" />
        </a><br/>
        <b>New Product</b>
    </div>
    <div class="button_block">
        <a href="#" id="dialog_link_search_product" >
            <img src="images/magnifier.png" alt="New Content" title="New Content" border="0" />
        </a>
        <br/>
        <b>Advanced Search</b>
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
                    <th width="100"><h3>&nbsp;ID</h3></th>
                    <th><h3>Product Name</h3></th>
                    <th width="100"><h3>SKU</h3></th>
                    <th width="150"><h3>Brand/Manufacturer</h3></th>
                    <th width="80"><h3>Price</h3></th>
                    <th width="80"><h3>Onsale</h3></th>
                    <th width="90"><h3>Stock Level</h3></th>
                    <th width="120"><h3>On/off the Shelf</h3></th>
                    <th width="50"><h3>Operations</h3></th>
                </tr>
            </thead>
            <tbody>
                <?
                require_once("../included/class_loader.php") ;
                require_once("../included/html_functions.php") ;

                $brand_id = $_REQUEST["brand_id"];
                $category_id_list = $_REQUEST["category_id_list"];

                $productManager = new ProductManager();
                $productList = $productManager->getProductListByCondition($brand_id, $category_id_list);

                if (sizeof($productList) > 0 ) {
                    foreach($productList as $product) {
                        $brand = new Manufacturer();
                        $brand = $product->get_manufacturer();
                        echo "  <tr>
                                <td>".$product->get_product_id()."</td>
                                <td>".$product->getProductDescriptionByLanguageID(1)->get_product_name()."</td>
                                <td>".$product->get_product_sku()."</td>
                                <td>".$brand->get_manufacturer_name()."</td>
                                <td>".$product->get_product_price()."</td>
                                <td>".$product->get_product_onsale_as_icon()."</td>
                                <td>".$product->get_product_stock_level()."</td>
                                <td>".$product->get_product_archived_as_icon()."</td>
                                <td>";

                        if ($product->get_product_archived() ==  "Y") {
                            echo    "<a href='process/admin_product_on_process.php?product_id=".$product->get_product_id()."'>".displayAddIcon(15,15,'put this product on the shelf')."</a>";
                        }else {
                            echo    "<a href='process/admin_product_off_process.php?product_id=".$product->get_product_id()."' >".displayDeleteIcon(15,15,'take this product off the shelf')."</a>";
                        }

                        echo"   <a href='index.php?view=admin_product_update&product_id=".$product->get_product_id()."' >".displayEditIcon(15,15,'Update this product')."</a>
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

    <div id="dialog_new_product" title="Create New Product">
        <br/>
        <form id="adminProductCreationForm"  action='process/admin_product_add_process.php' method='post'
              onsubmit='return checkAdminProductCreationForm(this)'>
            <table width="530" border="0" class="dialogTable" >
                <tr>
                    <td width="40%" align="right"><b>Brand/Manufacturer: </b></td>
                    <td>
                        <?
                        echo outputBrandsListAsDropdownList("brand_id", 230);
                        ?>
                    </td>
                </tr>
                <?
                $languageManager = new LanguageManager();
                $languageList = $languageManager->getLanguageList();
                if (sizeof($languageList) > 0) {
                    $language = new Language();
                    $count=0;
                    foreach($languageList as $language) {
                        echo"
                                <tr>
                                    <td align='right'><b>Product Name:</b></td>
                                    <td align='left'><input name='product_name".$language->get_language_id()."' id='product_name".$language->get_language_id()."' style='width: 230px;' />".$language->get_language_icon_as_image()."</td>
                                </tr>";
                        $count++;
                    }
                }
                ?>
                <tr>
                    <td  align="right"><b>SKU (Stock-keeping Unit Code): </b></td>
                    <td><input name="product_sku" id="product_sku" type='text' style="width: 230px;" /></td>
                </tr>
                <tr>
                    <td  align="right"><b>Date available: </b></td>
                    <td><input name="date_available" id="date_available" type='text' style="width: 100px;" /></td>
                </tr>
                <tr>
                    <td  align="right"><b>Stock Level: </b></td>
                    <td><input name="stock_level" id="stock_level" type='text' style="width: 100px;" value="0"/></td>
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


    <div id="dialog_search_product" title="Serach Product">
        <form id="adminProductSearchByCategory"  action='index.php?view=admin_product_list' method='post'>
            <table width="500" border="0" class="dialogTable"  cellpadding="3">
                <tr>
                    <td width="150" align="right" valign="top"><b>Brand/Manufacturer: </b></td>
                    <td>
                        <?
                        echo outputSearchBrandListAsDropdownList("brand_id", 250);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="150" align="right" valign="top"><b>Category: </b></td>
                    <td>
                        <ul style="margin: 0px; padding-left: 0px">
                            <?
                            $categoryManager = new CategoryManager();
                            $topCategoryList = $categoryManager->getTopCategoryList();
                            if (sizeof($topCategoryList)>0) {
                                foreach($topCategoryList as $category) {
                                    echo outputCategoryAsTreeNodeWithCheckbox($category);
                                }
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td height="20"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input name='Search' type='submit'  value='Search' class="ui-state-default ui-corner-all"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <br/>
</fieldset>

