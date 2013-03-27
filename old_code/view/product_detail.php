<script type="text/javascript">
    $(function(){
        // Tabs
        $("#Tabs").tabs();
    });
</script>
<script type="text/javascript" src="js/quickpager.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("ul.paging").quickPager({
            pageSize :5,
            currentPage:1,
            pagerLocation: "after"
        });
    });
</script>
<?
$product_id = secureRequestParameter($_REQUEST["product_id"]);
$product = new Product();
$product->load($product_id);

//increment the view count of the product
$product->updateProductViewedCount();

$brand = new Manufacturer();
$brand= $product->get_manufacturer();
?>
<div class="content">
    <h5><?=$product->getProductDescriptionByLanguageID($s_language_id)->get_product_name()?></h5>
    <div style="padding: 10px 10px 10px 10px ;">
        <table width="680" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="50%">
                                <div id="loadarea">
                                    <?
                                    $productImage = new ProductImage();
                                    $productImageManager = new ProductImageManager();
                                    $productImageManager->set_product_id($product->get_product_id());
                                    $productImage = $productImageManager->get_default_product_image();
                                    $productImage->set_product_image_path($s_configManager->getValueByKey("product_image_path"));

                                    $out ="<a href='".$productImage->get_image_full_path()."'>".$productImage->outputProductImage("", "", "", "product_detail_block_thumbnail")."</a>";
                                    echo $out;
                                    ?>
                                </div>
                            </td>

                            <td>
                                <table  width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <!-- product name -->
                                    <tr>
                                        <td align="left" width="25%"><span class="label_title">Product Name:</span></td>
                                        <td height="20">
                                            <span class="product_title"><b><?=$product->getProductDescriptionByLanguageID($s_language_id)->get_product_name()?></b></span>
                                        </td>
                                    </tr>
                                    <!-- seperator -->
                                    <tr>
                                        <td height="10" colspan='2'></td>
                                    </tr>

                                    <!-- product SKU -->
                                    <tr>
                                        <td align="left" width="25%"><span class="label_title">Product SKU:</span></td>
                                        <td height="20">
                                            <b><?=$product->get_product_sku()?></b>
                                        </td>
                                    </tr>

                                    <!-- seperator -->
                                    <tr>
                                        <td height="10" colspan='2'></td>
                                    </tr>

                                    <!-- brand name -->
                                    <tr>
                                        <td align="left" width="25%"><span class="label_title">Manufacturer:</span></td>
                                        <td height="20">
                                            <b><?=$brand->get_manufacturer_name()?></b>
                                        </td>
                                    </tr>


                                    <!-- seperator -->
                                    <tr>
                                        <td height="10" colspan='2'></td>
                                    </tr>


                                    <!-- price area -->
                                    <tr valign="bottom">
                                        <?
                                        $onsale_price ="";
                                        if ($product->get_product_presale_price_if_onale() != "") {
                                            $onsale_price =outputPriceWithCurrency($s_configManager, $product->get_product_presale_price_if_onale());
                                        }
                                        ?>
                                        <td align="left" width="25%"><span class="label_title">Our Price:</span></td>
                                        <td align="left"><span class='product_price_onsale'><?=$onsale_price?></span>
                                            <span class='product_price'><?=outputPriceWithCurrency($s_configManager, $product->get_product_price())?></span></td>
                                    </tr>

                                    <!-- seperator -->
                                    <tr>
                                        <td height="20" colspan='2'></td>
                                    </tr>

                                    <!-- image list -->
                                    <tr>
                                        <td  colspan='2'>
                                            <div id="proprico">
                                                <?
                                                $productImageList = $productImageManager->get_product_image_list();
                                                if (sizeof($productList) > 0) {
                                                    foreach($productImageList as $productImage) {
                                                        $productImage->set_product_image_path($s_configManager->getValueByKey("product_image_path"));
                                                        $out = "<div id='propricos'>";
                                                        $out = $out."<a href='".$productImage->get_image_full_path()."' rel='enlargeimage::mouseover' rev='loadarea::"
                                                                .$productImage->get_product_image_id()."' >";
                                                        $out = $out."<img src='".$productImage->get_image_full_path()."' width='40' border='0' height='40' style='float:left; border: 1px solid #E3E4E1;margin-right:3px;'>";
                                                        $out = $out."</a></div>";
                                                        echo $out;
                                                    }
                                                }

                                                ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- seperator -->
                                    <tr>
                                        <td height="20" colspan='2'></td>
                                    </tr>

                                    <!-- add to cart -->
                                    <tr>
                                    <form action="process/shopping_cart_add_process.php" >
                                        <td height="20" width="35%" valign="bottom" align="left">
                                            <input type="hidden" name="product_id" id="product_id" value="<?=$product->get_product_id()?>" />
                                            <span class="label_title">Product Quantity:</span>
                                        </td>
                                        <td height="10"  align="left">
                                            <input name="quantity" id="quantity" type="text"  style="width:35px; height:20px;float: left" value="1" />
                                            <input type="submit" value="Add to Cart" title="Add to Cart" class="blue_button_style" style="margin-left: 10px;"/>
                                        </td>
                                    </form>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
        </td>
        </tr>


        <!-- seperator -->
        <tr>
            <td height="30">
            </td>
        </tr>

        <tr>
            <td>
                <div id="Tabs" style="min-width:650px;font-size:100%; margin: 10px; ">

                    <ul>
                        <li style="width: 155px;"><a href="#Specification"><span>Specification</span></a></li>
                        <li style="width: 155px;"><a href="#Attribute"><span>Attributes</span></a></li>
                        <li style="width: 155px;"><a href="#Customer_Review"><span>Customer Review</span></a></li>
                        <li style="width: 155px;"><a href="#Shipping_methods"><span>Shipping Methods</span></a></li>
                    </ul>


                    <div id="Specification">
                        <?
                        $productDesc = new ProductDescription();
                        $productDesc = $product->getProductDescriptionByLanguageID($s_language_id);
                        echo $productDesc->get_product_description();
                        ?>
                    </div>

                    <div id="Attribute">
                        <?
                        $attributeManager = new AttributeManager();
                        $attributeList = $attributeManager->getAttributeList();
                        $productAttributeValueList =$product->get_product_attribute_list();

                        if (($productAttributeValueList != null ) && (sizeof($attributeList)>0)) {
                            echo "<table width='600' border='0'  cellpadding='5' cellspacing='0' class='table_style'>";
                            foreach($attributeList as $attribute) {
                                echo "<tr>
                                       <td width='20%' align='right'><span class='label_title'>".$attribute->get_attribute_name().":</span></td>
                                       <td align='left'><span class='label_title'>&nbsp;";
                                if (sizeof($attribute->get_attribute_value_list())>0) {
                                    foreach($attribute->get_attribute_value_list() as $attributeValue) {

                                        foreach($productAttributeValueList as $productAttribute) {
                                            if ($productAttribute->get_attribute_value_id() == $attributeValue->get_attribute_value_id()) {
                                                echo $productAttribute->get_attribute_value()."&nbsp;&nbsp;";
                                            }
                                        }
                                    }
                                }
                                echo "</span></td></tr>";

                            }
                            echo "</table>";
                        }

                        ?>
                    </div>


                    <div id="Customer_Review">
                        <?
                        if ($s_configManager->getValueByKey("show_review") == "Y") {
                            $uni_id = uniqid();


                            $review_list = $product->get_product_review_list();
                            if($review_list != null && sizeof($review_list) > 0) {
                                $field = "<ul class='paging'>";
                                foreach($review_list as $review) {
                                    $uni_id = uniqid();
                                    $field = $field."
                                                <li>
                                           <table width='600' border='0'>
                                                <tr>
                                                <td width='100'>".outputStarRatingReadOnly($review->get_review_rate(),$uni_id)."</td>
                                                    <td ><p><b>By </b>".$review->get_customer()->get_full_name()."</p></td>
                                                    <td width='250'><p>At  ".$review->get_review_date()."</p></td>
                                                </tr>
                                                <tr>
                                                    <td colspan='3'><p>".$review->get_review_text()."</p></td>
                                                </tr>
                                            </table></li>";
                                }
                                $field = $field."</ul>";
                                echo $field;
                            }else {
                                echo "<p>There is no customer review.<p>";
                            }
                        }else {
                            echo "<p>There is no customer review.<p>";
                        }

                        $customerManager = new CustomerManager();
                        if ($s_cart->get_customer_login()) {
                            // see if customer logged in , then he might be able to leave review
                            if (!$customerManager->checkCustomerReviewExist($s_cart->get_customer_id(), $product_id)) {
                                echo "
                            <div class='rating_area'>
                            <table width='600' border='0' style='margin-top: 20px;font-size:12px'>
                                    <form action='process/customer_post_review_process.php' method='post'
                            onsubmit='return checkCustomerReviwForm(this)'>
                                            <input type='hidden' name='customer_id' id='customer_id' value='".$s_cart->get_customer_id()."'/>
                                            <input type='hidden' name='product_id' id='product_id' value='".$product_id."'/>
                                    <tr valign='top'>
                                            <td width='100' align='left' ><span class='label_title'>Rating: </span></td>
                                            <td>
                                                    ".outputStarRating('review_rate')."
                                            </td>
                                    </tr>
                                    <tr valign='top'>
                                            <td><span class='label_title'>Review: </span></td>
                                            <td><textarea cols='30' rows='3' name='review_text' id='review_text'></textarea></td>
                                    </tr>
                                    <tr><td></td>
                                            <td>
                                               <input type='submit' value='Post' title='Post' class='blue_button_style'/>
                                            </td>
                                    </tr>
                                     </form>
                            </table>
                            </div>";
                            }else {
                                echo "<div class='rating_area'><p>You have left your review already.</p></div>";
                            }
                        }


                        ?>




                    </div>


                    <div id="Shipping_methods">
                        <?
                        echo outputShippingMethodsAsTable($s_configManager);
                        ?>
                    </div>
                </div>
            </td>
        </tr>
        </table>
    </div>
</div>




