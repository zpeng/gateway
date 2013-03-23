<link rel="stylesheet" type="text/css" href="styles/checkboxtree.css" charset="utf-8">
<script src="js/jquery.checkboxtree.js" type="text/javascript" language="JavaScript"></script>
<script>
    jQuery(document).ready(function(){
        jQuery(".categoryTreeViewCheckBox").checkboxTree({
            collapsedarrow: "images/checkboxtree/img-arrow-collapsed.gif",
            expandedarrow: "images/checkboxtree/img-arrow-expanded.gif",
            blankarrow: "images/checkboxtree/img-arrow-blank.gif",
            checkchildren: false,
            collapsed: false
        });
    });
</script>
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

        // Dialog
        $('#dialog_product_image').dialog({
            autoOpen: false,modal: true,
            width: 500,
            buttons: {
                "Cancel": function() {
                    $(this).dialog("close");
                }
            }
        });

        // Dialog Link
        $('#dialog_link_product_image').click(function(){
            $('#dialog_product_image').dialog('open');
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
        <span class="title"> Product Edit</span>
    </div>
    <div class="button_block">
        <a href="index.php?view=admin_product_list">
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
    <?
    require_once("../included/class_loader.php") ;
    require_once('../included/html_functions.php');
    include_once("../fckeditor/fckeditor.php") ;

    $product_id = secureRequestParameter($_REQUEST["product_id"]);
    $product = new Product();
    $product->load($product_id);

    ?>
    <div id="Tabs" style="width:100%; min-width:1000px;font-size:100%; margin: 0px; ">
        <ul>
            <li style="font-size:80%"><a href="#Tabs-1">Product Detail</a></li>
            <li style="font-size:80%"><a href="#Tabs-2">Product Description</a></li>
            <li style="font-size:80%"><a href="#Tabs-3">Product Category</a></li>
            <li style="font-size:80%"><a href="#Tabs-4">Product Attributes</a></li>
            <li style="font-size:80%"><a href="#Tabs-5">Product Gallery</a></li>
            <li style="font-size:80%"><a href="#Tabs-6">Product Review</a></li>
        </ul>

        <!--  Product Detail -->
        <div id="Tabs-1" style="float: left">
            <form id="productDetailUpdateForm"  action='process/admin_product_detail_update_process.php' method='post'
                  onsubmit='return checkAdminProductDetailUpdateForm(this)'>
                <table width="700" border="0"  >
                    <tr>
                        <td align="right"></td>
                        <td align="left">
                            <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  /></td>
                    </tr>
                    <tr>
                        <td  align="right"</td>
                        <td align="left"></td>
                    </tr>
                    <tr>
                        <td width="30%" align="right"><b>Product ID: </b></td>
                        <td><input name="product_id" id="product_id" style="width: 100px;"
                                   readonly="true" value="<?=$product->get_product_id()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" align="right"><b>Product SKU: </b></td>
                        <td><input name="product_sku" id="product_sku" style="width: 250px;"
                                   value="<?=$product->get_product_sku()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Brand/Manufacturer: </b></td>
                        <td>
                            <?
                            echo outputBrandsListAsDropdownList("brand_id", 250, $product->get_manufacturer_id());
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Product Cost: </b></td>
                        <td><input name="product_cost" id="product_cost" style="width: 100px;"    value="<?=$product->get_product_cost()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Product Price: </b></td>
                        <td><input name="product_price" id="product_price" style="width: 100px;"    value="<?=$product->get_product_price()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Product Onsale: </b></td>
                        <td>
                            <?
                            echo outputBooleanValueAsDropdownList("product_onsale", 50, $product->get_product_onsale());
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Product Presale Price: </b></td>
                        <td><input name="product_presale_price" id="product_presale_price" style="width: 100px;"    value="<?=$product->get_product_presale_price()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td align="right"><b>Product URL: </b></td>
                        <td><input name="product_url" id="product_url" style="width: 250px;"    value="<?=$product->get_product_url()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Product Weight: </b></td>
                        <td><input name="product_weight" id="product_weight" style="width: 100px;"    value="<?=$product->get_product_weigth()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Product Stock Level: </b></td>
                        <td><input name="product_stock_level" id="product_stock_level" style="width: 100px;"    value="<?=$product->get_product_stock_level()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td  align="right"><b>Creation Date: </b></td>
                        <td><input name="date_add" id="date_add" type='text' style="width: 100px;"
                                   value="<?=$product->get_product_date_added()?>" readonly="true"/></td>
                    </tr>
                    <tr>
                        <td  align="right"><b>Available Date</b></td>
                        <td><input name="date_available" id="date_available" type='text' style="width: 100px;" value="<?=$product->get_product_date_available()?>" /></td>
                    </tr>
                </table>
            </form>
        </div>

        <!--  Product Description -->
        <div id="Tabs-2" style="float: left">
            <form id="productDescUpdateForm"  action='process/admin_product_description_update_process.php' method='post'
                  onsubmit='return checkAdminProductDescriptionUpdateForm(this)'>
                <table width="700" border="0">
                    <tr><td align="right"><input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  /></td></tr>
                    <tr><td align="left">
                            <input name="product_id" id="product_id" type="hidden" value="<?=$product->get_product_id()?>"/>
                            <div id="accordion" style="min-width: 700px; width: 100%">
                                <dl class="accordion" id="my_accordion" >
                                    <?
                                    $languageManager = new LanguageManager();
                                    $languageList = $languageManager->getLanguageList();
                                    if (sizeof($languageList) > 0) {
                                        $language = new Language();
                                        foreach($languageList as $language) {
                                            $productDesc = new ProductDescription();
                                            $productDesc = $product->getProductDescriptionByLanguageID($language->get_language_id());

                                            if ($productDesc != null) {
                                                echo "<dt>".$language->get_language_icon_as_image()."</dt>
                          <dd>
                            <center><br/>
                            <table width='700' border='0' style='font:100%;' cellpadding='3' >
                                    <td width='100' align='right'><b>Product Name: </b></td>
                                    <td align='left'><input name='product_name".$productDesc->get_language_id()."' style='width: 300px;' value='".$productDesc->get_product_name()."' /></td>
                                </tr>
                                <tr>
                                    <td width='100' align='right' valign='top'><b>Description: </b></td>
                                    <td align='left' height='400'> ";
                                                $article = "product_desc".$productDesc->get_language_id();
                                                $oFCKeditor = new FCKeditor($article) ;
                                                $oFCKeditor->Height = '412' ;
                                                $oFCKeditor->BasePath = '../fckeditor/' ;
                                                $oFCKeditor->Value = $productDesc->get_product_description();
                                                $oFCKeditor->Create() ;

                                                echo "
                                    </td>
                                </tr>
                            </table>
                            <br/>
                            </center>
                        </dd>
                        ";
                                            }else {
                                                echo " <dt>".$language->get_language_icon_as_image()."</dt>
                           <dd>
                            <center>
                            <table width='700' border='0' style='font:100%;' cellpadding='3' >
                                    <td width='100' align='right'><b>Product Name: </b></td>
                                    <td align='left'><input name='product_name".$language->get_language_id()."' style='width: 300px;'  /></td>
                                </tr>
                                       <tr>
                                       <td width='100' align='right' valign='top'><b>Description: </b></td>
                                    <td align='left' height='400'> ";
                                                $article = "product_desc".$language->get_language_id();
                                                $oFCKeditor = new FCKeditor($article) ;
                                                $oFCKeditor->Height = '412' ;
                                                $oFCKeditor->BasePath = '../fckeditor/' ;
                                                $oFCKeditor->Create() ;

                                                echo "
                                    </td>
                                </tr>
                            </table>
                            </center>
                        </dd>";
                                            }
                                            $count++;
                                        }
                                    }
                                    ?>
                                </dl>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <!--  Product Category -->
        <div id="Tabs-3" style="float: left">
            <form id="productCategoryUpdateForm"  action='process/admin_product_category_update_process.php' method='post'
                  onsubmit='return checkAdminProductCategoryUpdateForm(this)'>
                <input name="product_id" id="product_id" type="hidden" value="<?=$product->get_product_id()?>"/>
                <table width="700" border="0">
                    <tr><td align="right"><input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  /></td></tr>
                    <tr><td align="left">
                            <ul id="categoryTreeViewCheckBox" class="categoryTreeViewCheckBox" style="margin-left: 25px"  >
                                <?
                                $categoryManager = new CategoryManager();
                                $topCategoryList = $categoryManager->getTopCategoryList();
                                if (sizeof($topCategoryList)>0) {
                                    foreach($topCategoryList as $category) {
                                        echo outputCategoryAsTreeNodeWithCheckbox($category, $product->get_category_id_list());
                                    }
                                }
                                ?>
                            </ul>
                        </td></tr>
                </table>
            </form>    
        </div>

        <!--  Product Attributes -->
        <div id="Tabs-4" style="float: left">
            <form id="productAttributeValueUpdateForm"  action='process/admin_product_attribute_value_update_process.php' method='post'>
                <input name="product_id" id="product_id" type="hidden" value="<?=$product->get_product_id()?>"/>
                <table width="700" border="0">
                    <tr>
                        <td align="right">
                            <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  />
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <?
                            $attributeManager = new AttributeManager();
                            $productAttributeList = $product->getProductAttributeValueList();
                            echo outpoutProductAttributeValueView( $attributeManager->getAttributeList(), $productAttributeList);
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <!--  Product Gallery -->
        <div id="Tabs-5" style="float: left">
            <table width="700" border="0">
                <tr>
                    <td align="right">
                        <a href="#" id="dialog_link_product_image">
                            <img src="images/add_24.png" alt="New Image" title="New Image" border="0" style="height:25px; width:25px;"/>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <?
                        $productImageManager = new ProductImageManager();
                        $productImageManager->set_product_id($product_id);
                        $productImageManager->set_image_path("../images/products/");
                        $productImageList = $productImageManager->get_product_image_list();

                        ?>

                        <table cellpadding="0" cellspacing="0" border="0" class="tinytable">
                            <thead >
                                <tr>
                                    <th><h3>Product Image</h3></th>
                                    <th><h3>Is it default?</h3></th>
                                    <th><h3>Operations</h3></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                if (sizeof($productImageList) > 0 ) {
                                    foreach($productImageList as $productImage) {
                                        echo "  <tr>
                                                <td>".$productImage->outputProductImage(100,100)."</td>
                                                <td>".$productImage->get_product_image_default_as_icon()."</td>
                                                <td>
 <a href='process/admin_product_image_delete_process.php?product_image_id=".$productImage->get_product_image_id()."&product_id=".$product->get_product_id()."'
                                onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Delete this product image')."</a>
 <a href='process/admin_product_image_update_process.php?product_image_id=".$productImage->get_product_image_id()."&product_id=".$product->get_product_id()."'
                                >".displayEditIcon(15,15,'Set this image as default')."</a>
                                                </td>
                                                </tr> ";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
            <div id="dialog_product_image" title="Add New Image">
                <form name='productImageUpload'action='process/admin_product_image_add_process.php' method='post' enctype='multipart/form-data'>
                    <input name='product_id' type='hidden' value='<? echo $product->get_product_id() ?>' />
                    <table width="500" border="0" class="dialogTable" >
                        <tr>
                            <td width="30%" align="right" ><b>Load From File:</b></td>
                            <td><input name="image_uploaded" type='file' style="width: 250px;"  /></td>
                        </tr>

                        <tr>
                            <td width="30%" align="right" ></td>
                            <td><input name='Upload Image' type='submit' value='Upload Image' style='margin-left:0px' /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <!--  Product Review -->
        <div id="Tabs-6" style="float: left">
            <table width="700" border="0">
                <tr>
                    <td align="left">
                        <?
                        $review_list = $product->get_product_review_list();

                        ?>

                        <div id="tablewrapper" style="width: 700px;">
                            <div id="tableheader" style="width: 700px;">
                                <div class="search">
                                    <select id="columns" onchange="sorter.search('query')"></select>
                                    <input type="text" id="query" onkeyup="sorter.search('query')" />
                                </div>
                                <span class="details">
                                    <div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
                                    <div><a href="javascript:sorter.reset()">reset</a></div>
                                </span>
                            </div>
                            <table cellpadding="0" cellspacing="0" border="0" id="table"  class="tinytable" style="width: 700px;">
                                <thead >
                                    <tr>
                                        <th><h3>Client Email</h3></th>
                                        <th><h3>Client Name</h3></th>
                                        <th><h3>Rate</h3></th>
                                        <th><h3>Reviews</h3></th>
                                        <th><h3>Date</h3></th>
                                        <th><h3>Operations</h3></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    if (sizeof($review_list) > 0 ) {
                                        foreach($review_list as $review) {
                                            echo "  <tr>
                                                <td>".$review->get_customer()->get_email()."</td>
                                                <td>".$review->get_customer()->get_full_name()."</td>
                                                <td>".$review->get_review_rate()."</td>
                                                <td>".$review->get_review_text()."</td>
                                                <td>".$review->get_review_date()."</td>
                                                <td>
 <a href='process/admin_product_review_delete_process.php?review_id=".$review->get_review_id()."&product_id=".$product->get_product_id()."'
                                onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Delete this product review')."</a>
                                                </td>
                                                </tr> ";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div id="tablefooter" style="width: 700px;">
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
                                            <option value="5"  selected="selected">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <span>Entries Per Page</span>
                                    </div>
                                    <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
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
                                    sortcolumn:1,
                                    sortdir:1,
                                    columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
                                    init:true
                                });
                            </script>

                        </div>

                    </td>
                </tr>
            </table>

        </div>
    </div>


</fieldset>


<script type="text/javascript">
    var my_accordion=new accordion.slider("my_accordion");
    my_accordion.init("my_accordion",0,"open");
</script>