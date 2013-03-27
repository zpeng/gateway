<script type="text/javascript" src="js/quickpager.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("ul.paging").quickPager({
            pageSize :10,
            currentPage:1,
            pagerLocation: "after"
        });
    });
</script>
<?

$category_id = secureRequestParameter($_REQUEST["category_id"]);
$category = new Category();
$category->load($category_id);

?>

<div class="content">
    <h5><?=$category->get_category_name()?></h5>
    <br/>
    <center>

        <?
        $productManager = new ProductManager();
        $productList = $productManager->getProductByCategory($category_id);
        if (sizeof($productList) >0 ) {
            echo "<ul class='paging'>";
            foreach($productList as $product) {
                //$product = new Product();
                $brand = new Manufacturer();
                $brand= $product->get_manufacturer();

                $productImage = new ProductImage();
                $productImageManager = new ProductImageManager();
                $productImageManager->set_product_id($product->get_product_id());
                $ProductImage = $productImageManager->get_default_product_image();
                $ProductImage->set_product_image_path($s_configManager->getValueByKey("product_image_path"));

                $onsale_price ="";
                if ($product->get_product_presale_price_if_onale() != "") {
                    $onsale_price = outputPriceWithCurrency($s_configManager,$product->get_product_presale_price_if_onale());
                }

                echo "
<li>
<table width='650' border='0'>
<tr>
<td width='200'>
".$ProductImage->outputProductImage("", "", "", "product_block_thumbnail")."
</td>
<td width='15'>
</td>
<td>
<table width='100%' border='0'>
<tr>
<td height='20' align='left'>
<a href='index.php?view=product_detail&product_id=".$product->get_product_id()."'><span class='product_title'>".$product->getProductDescriptionByLanguageID($s_language_id)->get_product_name()."</span></a>
</td>
</tr>
<tr><td height='5'></td></tr>
<tr><td height='20' align='left'>
<span class='brand_title'>".$brand->get_manufacturer_name()."</span>
</td></tr>";

                if ($s_configManager->getValueByKey("show_review") == "Y") {
                    $field ="<tr><td height='5'></td></tr><tr><td height='20' align='left'>";
                    $uni_id = uniqid();
                    $field = $field.outputStarRatingReadOnly($product->getProductAverageRating(),$uni_id);
                    $field = $field."</td></tr>";
                    echo $field;
                }

                echo "
<tr><td height='5'></td></tr>
<tr><td height='20' align='left'>
<span class='product_price_onsale'>".$onsale_price."</span>
<span class='product_price'>".outputPriceWithCurrency($s_configManager,$product->get_product_price())."</span>
</td></tr>
<tr><td height='5'>
</td></tr>
<tr><td height='20' align='left'>
<div class='gray_button_box'>
<a href='index.php?view=product_detail&product_id=".$product->get_product_id()."'>Product Detail</a>
</div>
<div class='blue_button_box'><a  href='process/shopping_cart_add_process.php?quantity=1&product_id=".$product->get_product_id()."'>Add to Cart</a></div>
</td></tr>
</table>
</td>
</tr>
</table>
</li>                      ";
            }
            echo "</ul>";
        }
        ?>
    </center>
</div>

