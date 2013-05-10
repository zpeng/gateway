<?php

function createGenericTable($id = "", $class = "", $dataSource)
{
    $htmlTable = "<table id='$id' class='$class'>";
    $htmlTable = $htmlTable . "<thead><tr>";

    foreach ($dataSource["header"] as $head_value) {
        $htmlTable = $htmlTable . "<th>" . $head_value . "</th>";
    }
    $htmlTable = $htmlTable . "</tr></thead>";

    $htmlTable = $htmlTable . "<tbody>";
    foreach ($dataSource["body"] as $row) {
        $htmlTable = $htmlTable . "<tr>";
        foreach ($row as $cell) {
            $htmlTable = $htmlTable . " <td>" . $cell . "</td>";
        }
        $htmlTable = $htmlTable . "</tr>";
    }
    $htmlTable = $htmlTable . "</tbody>";

    $htmlTable = $htmlTable . "</table>";
    return $htmlTable;
}

function createCheckboxList($id = "", $class = "", $name = "", $dataSource)
{
    /*
    $dataSource = array(
        "data" => array(
            "key1" => "value1",
            "key2" => "value2",
            "key3" => "value3",
            "key4" => "value4",
            "key5" => "value5",
        ),
        "selected" => array(
            "key1" => "value1",
            "key4" => "value4",
        )
    );
    */

    $html = "<ul class='$class' id='$id'>";
    if (array_key_exists("data", $dataSource) && sizeof($dataSource["data"]) > 0) {
        foreach ($dataSource["data"] as $key => $value) {
            if (array_key_exists("selected", $dataSource) && array_key_exists($key, $dataSource["selected"])) {
                $html = $html . "<li><input  checked='true' type='checkbox'  name='$name' value='" . $value . "'><label>" . $key . "</label>";
            } else {
                $html = $html . "<li><input type='checkbox'  name='$name' value='" . $value . "'><label>" . $key . "</label>";
            }
        }
    }
    return $html = $html . "</ul>";
}

function createTreeviewRadioList($id = "", $class = "", $name = "", $dataSource = array(), $selectedValue = "")
{
    /*
    $dataSource = array(
     array(
            "id" => "1",
            "label" => "item 1",
            "children" => array(
                "2" => array(
                    "id" => "2",
                    "label" => "item 2",
                    "children" => array()
                ),
                "3" => array(
                    "id" => "3",
                    "label" => "item 3",
                    "children" => array()
                )
            )
    )
    );*/

    $html = "<ul class='$class' id='$id'>";
    foreach ($dataSource as $value) {
        if ($value["id"] == $selectedValue) {
            $html = $html . "<li><input  checked='true' type='radio'  name='$name' value='" . $value["id"] . "'><label>" . $value["label"] . "</label>";
        } else {
            $html = $html . "<li><input type='radio'  name='$name' value='" . $value["id"] . "'><label>" . $value["label"] . "</label>";
        }

        if (sizeof($value["children"]) > 0) {
            $html = $html . "<ul>";
            foreach ($value["children"] as $child) {
                $html = $html . createTreeviewRadioChild($name, $child, $selectedValue);
            }
            $html = $html . "</ul>";
        }
    }
    return $html = $html . "</ul>";
}

function createTreeviewRadioChild($name = "", $value = array(), $selectedValue = "")
{
    $html="";
    if ($value["id"] == $selectedValue) {
        $html = $html . "<li><input  checked='true' type='radio'  name='$name' value='" . $value["id"] . "'><label>" . $value["label"] . "</label>";
    } else {
        $html = $html . "<li><input type='radio'  name='$name' value='" . $value["id"] . "'><label>" . $value["label"] . "</label>";
    }

    if (sizeof($value["children"]) > 0) {
        $html = $html . "<ul>";
        foreach ($value["children"] as $child) {
            $html = $html . createTreeviewRadioChild($name, $child, $selectedValue);
        }
        $html = $html . "</ul>";
    }
    return $html;
}

function createDropdownList($id = "", $name = "", $class = "", $style = "", $display_size = "1", $dataSource)
{
    /*
    $dataSource = array(
        "data" => array(
            "key1" => "value1",
            "key2" => "value2",
            "key3" => "value3",
            "key4" => "value4",
            "key5" => "value5",
        ),
        "selected" => array(
            "key1" => "value1",
            "key4" => "value4",
        )
    );
    */

    $html = "<select id='" . $id . "' name='" . $name . "' class='$class' style='$style' size='$display_size'>";
    if (sizeof($dataSource["data"]) > 0) {
        foreach ($dataSource["data"] as $key => $value) {
            if (array_key_exists("selected", $dataSource) && array_key_exists($key, $dataSource["selected"])) {
                $html = $html . "<option  value='" . $value . "' selected>" . $key . "</option>";
            } else {
                $html = $html . "<option  value='" . $value . "'>" . $key . "</option>";
            }
        }
    }
    return $html = $html . "</select>";
}


/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/*--- Admin Menu manager ajax ---*/
function outputMenuTypeListAsDropdownListAjax($inputName = '', $width = '')
{
    $menuManager = new MenuManager();
    $menuTypeList = $menuManager->getMenuTypeList();
    $field = "<select id='" . $inputName . "' name='" . $inputName . "' style='width:" . $width . "px' onchange='showMenuParentDropdownList(this.value)'>";
    $field = $field . "<option value='0' selected='true'>Select a Menu Type</option>";
    if (sizeof($menuTypeList) > 0) {
        $menuType = new MenuType();
        foreach ($menuTypeList as $menuType) {
            $field = $field . "<option value='" . $menuType->get_menu_type_id() . "'>&nbsp;&nbsp;-" . $menuType->get_menu_type_name() . "</option>";
        }
    }
    $field = $field . "</select>";
    return $field;
}

function outputMenuTypeListAsDropdownList($menuTypeList, $inputName = '', $width = '', $defaultSelectValue = '')
{
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px'>";
    if (sizeof($menuTypeList) > 0) {
        $menuType = new MenuType();
        foreach ($menuTypeList as $menuType) {
            if ($defaultSelectValue == $menuType->get_menu_type_name()) {
                $field = $field . "<option  selected='selected' value='" . $menuType->get_menu_type_id() . "'>" . $menuType->get_menu_type_name() . "</option>";
            } else {
                $field = $field . "<option value='" . $menuType->get_menu_type_id() . "'>" . $menuType->get_menu_type_name() . "</option>";
            }
        }

    } else {
        $field = $field . "<option value='0'>No value defined</option>";
    }
    $field = $field . "</select>";
    return $field;
}

function outputMenuItemListAsDropdownList($menuItemList, $inputName = '', $width = '')
{
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    $field = $field . "<option value='0'> As parent </option>";
    if (sizeof($menuItemList) > 0) {
        $menu = new Menu();
        foreach ($menuItemList as $menu) {
            $field = $field . "<option value='" . $menu->get_menu_id() . "'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_" . $menu->getDefaultMenuDescription()->get_menu_name() . "</option>";
        }
    }
    $field = $field . "</select>";
    return $field;
}

function outputLinkTypeListAsDropdownListAjax($inputName = '', $width = '')
{
    $field = "<select id='" . $inputName . "' name='" . $inputName . "' style='width:" . $width . "px' onchange='showLinkTypeDropdownList(this.value)'>";
    $field = $field . "<option  selected='selected'  value='-1'> Select a category</option>";
    $field = $field . "<option   value='0'>&nbsp;&nbsp;-Customize Link</option>";
    $field = $field . "<option   value='1'>&nbsp;&nbsp;-Contents</option>";
    $field = $field . "</select>";

    return $field;
}

function outputContentAsTreeNodeRadioBox()
{
    $field = "<ul>";
    $contentManager = new ContentManager();
    $contentList = $contentManager->getContentList();
    if (sizeof($contentList) > 0 && $contentList != null) {
        foreach ($contentList as $content) {
            // $content = new Content();
            $field = $field .
                "<li><input type='radio' value='" . $content->get_content_id() . "' name='content_id'> <label>" . $content->get_first_content_description()->get_title() . "</label>";
        }
    }
    $field = $field . "</ul>";
    return $field;
}



/*-----   UI output ----*/
function displayDeleteIcon($width, $height, $msg)
{
    $str = "<img  alt='$msg' title='$msg' width='$width' height='$height' src='" . SERVER_URL . "admin/images/delete.png' border='0' />";
    return $str;
}

function displayEditIcon($width, $height, $msg)
{
    $str = "<img  alt='$msg' title='$msg' width='$width' height='$height' src='" . SERVER_URL . "admin/images/edit.png' border='0' />";
    return $str;
}

function displayAddIcon($width, $height, $msg)
{
    $str = "<img  alt='$msg' title='$msg' width='$width' height='$height'
             src='images/plus-button.png' border='0' />";
    return $str;
}

function outputBooleanValueAsDropdownList($inputName = '', $width = '', $defaultSelectValue = '')
{
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    if ($defaultSelectValue == "Y") {
        $field = $field . "<option  selected='selected' value='Y'>Yes</option>";
    } else {
        $field = $field . "<option value='Y'>Yes</option>";
    }

    if ($defaultSelectValue == "N") {
        $field = $field . "<option  selected='selected' value='N'>No</option>";
    } else {
        $field = $field . "<option value='N'>No</option>";
    }

    $field = $field . "</select>";

    return $field;
}

function outputOrderStatusAsDropdownList($inputName = '', $width = '', $defaultSelectValue = '')
{
    $status_id = 1;
    $orderStatus = New OrderStatus();
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    foreach ($orderStatus->get_order_status_value() as $statusValue) {
        if ($defaultSelectValue == $status_id) {
            $field = $field . "<option  selected='selected' value='$status_id'>$statusValue</option>";
        } else {
            $field = $field . "<option value='$status_id'>$statusValue</option>";
        }
        $status_id++;
    }
    $field = $field . "</select>";
    return $field;
}


function outputPaymentStatusAsDropdownList($inputName = '', $width = '', $defaultSelectValue = '')
{
    $status_id = 1;
    $paymentStatus = New PaymentStatus();
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    foreach ($paymentStatus->get_payment_status_value() as $statusValue) {
        if ($defaultSelectValue == $status_id) {
            $field = $field . "<option  selected='selected' value='$status_id'>$statusValue</option>";
        } else {
            $field = $field . "<option value='$status_id'>$statusValue</option>";
        }
        $status_id++;
    }
    $field = $field . "</select>";
    return $field;
}

/*--- Languages ---*/
function outputLanguageDefaultListAsDropdownList($inputName = '', $width = '', $defaultSelectValue = '')
{
    $languageManager = new LanguageManager();
    $languageDefaultList = $languageManager->getLanguageDefaultList();
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    if (sizeof($languageDefaultList) > 0) {
        $languageDefault = new LanguageDefault();
        foreach ($languageDefaultList as $languageDefault) {

            if ($defaultSelectValue == $languageDefault->get_language_default_initial()) {
                $field = $field . "<option  selected='selected' value='" . $languageDefault->get_language_default_id() . "'>" . $languageDefault->get_language_default_initial() . "</option>";
            } else {
                $field = $field . "<option value='" . $languageDefault->get_language_default_id() . "'>" . $languageDefault->get_language_default_initial() . "</option>";
            }
        }
    } else {
        $field = $field . "<option value='0'>No value defined</option>";
    }
    $field = $field . "</select>";

    return $field;
}



/*--- category Tree ---*/
function outputCategoryAsTreeNode($category)
{
//$category = new Category();
    $subCategoryList = $category->get_category_children_list();

    $field = "<li><label>" . $category->get_category_name() . "</label>";

    $field = $field . " - (" . sizeof($subCategoryList) . ") - ";
    $field = $field . " <a href='process/admin_category_delete_process.php?id=" . $category->get_category_id() . "' onclick='return confirmDeletion()'>" . displayDeleteIcon(15, 15, "Delete") . "</a>";
    $field = $field . " <a href='index.php?view=admin_category_update&id=" . $category->get_category_id() . "'>" . displayEditIcon(15, 15, "Update") . "</a>";
    $field = $field . " <a href='index.php?view=admin_category_add_sub&parent_category_id=" . $category->get_category_id() . "'>" . displayAddIcon(15, 15, "Add sub-category") . "</a>";

    // get more sub categories
    $field = $field . "<ul  rel='open'>";
    if (sizeof($subCategoryList) > 0) {
        foreach ($subCategoryList as $subCategory) {
            $field = $field . outputCategoryAsTreeNode($subCategory);
        }
    }
    $field = $field . "</ul>";

    $field = $field . "</li>";
    return $field;
}

function outputCategoryAsTreeNodeWithCheckbox($category, $pre_exist_category_list = "")
{
    $subCategoryList = $category->get_category_children_list();
    $found = false;
    if (sizeof($pre_exist_category_list) > 0 && $pre_exist_category_list != null) {
        foreach ($pre_exist_category_list as $pre_exist_category_id) {
            if ($pre_exist_category_id == $category->get_category_id()) {
                $found = true;
            }
        }

        if ($found) {
            $field = "<li><input  checked='true' type='checkbox' name='category_id_list[]' value='" . $category->get_category_id() . "'><label>" . $category->get_category_name() . "</label>";
        } else {
            $field = "<li><input type='checkbox' name='category_id_list[]' value='" . $category->get_category_id() . "'><label>" . $category->get_category_name() . "</label>";
        }
    } else {
        $field = "<li><input type='checkbox' name='category_id_list[]' value='" . $category->get_category_id() . "'><label>" . $category->get_category_name() . "</label>";
    }


    // get more sub categories
    $field = $field . "<ul>";
    if (sizeof($subCategoryList) > 0) {
        foreach ($subCategoryList as $subCategory) {
            $field = $field . outputCategoryAsTreeNodeWithCheckbox($subCategory, $pre_exist_category_list);
        }
    }
    $field = $field . "</ul>";


    $field = $field . "</li>";
    return $field;
}


/*--- Product Attribute & Atrribute Value ---*/
function outputAtrributeValueListAsDropdownList($attributeValueList, $inputName = '', $width = '', $defaultSelectValue = '')
{
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    if (sizeof($attributeValueList) > 0) {
        $attributeValue = new AttributeValue();
        foreach ($attributeValueList as $attributeValue) {

            if ($defaultSelectValue == $attributeValue->get_attribute_value_id()) {
                $field = $field . "<option  selected='selected' value='" . $attributeValue->get_attribute_value_id() . "'>" . $attributeValue->get_attribute_value() . "</option>";
            } else {
                $field = $field . "<option value='" . $attributeValue->get_attribute_value_id() . "'>" . $attributeValue->get_attribute_value() . "</option>";
            }
        }
    } else {
        $field = $field . "<option value='0'>No value defined</option>";
    }
    $field = $field . "</select>";

    return $field;
}

function outputAtrributeListAsDropdownList($attributeList, $inputName = '', $width = '', $defaultSelectValue = '')
{
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    if (sizeof($attributeList) > 0) {
        $attribute = new Attribute();
        foreach ($attributeList as $attribute) {
            if ($defaultSelectValue == $attribute->get_attribute_id()) {
                $field = $field . "<option  selected='selected' value='" . $attribute->get_attribute_id() . "'>" . $attribute->get_attribute_name() . "</option>";
            } else {
                $field = $field . "<option value='" . $attribute->get_attribute_id() . "'>" . $attribute->get_attribute_name() . "</option>";
            }
        }
    } else {
        $field = $field . "<option value='0'>No value defined</option>";
    }
    $field = $field . "</select>";

    return $field;
}


function outpoutProductAttributeValueView($attributeList, $productAttributeValueList)
{
    $field = "";
    if (sizeof($attributeList) > 0 && $attributeList != null) {
        foreach ($attributeList as $attribute) {
            $field = $field . "<fieldset class='attribute_fieldset'><legend>" . $attribute->get_attribute_name() . "</legend>";
            if (sizeof($attribute->get_attribute_value_list()) > 0) {
                foreach ($attribute->get_attribute_value_list() as $attributeValue) {
                    $found = false;
                    if (sizeof($productAttributeValueList) > 0) {
                        foreach ($productAttributeValueList as $productAttributeValue) {
                            if ($attributeValue->get_attribute_value_id() == $productAttributeValue->get_attribute_value_id()) {
                                $found = true;
                            }
                        }
                    }
                    if ($found) {
                        $field = $field . "<input  type='checkbox' checked='true' name='product_attribute_value_id_list[]' value='" . $attributeValue->get_attribute_value_id() . "'><label class='attribute_checkbox_label'>" . $attributeValue->get_attribute_value() . "</label>";
                    } else {
                        $field = $field . "<input  type='checkbox' name='product_attribute_value_id_list[]' value='" . $attributeValue->get_attribute_value_id() . "'><label class='attribute_checkbox_label'>" . $attributeValue->get_attribute_value() . "</label>";
                    }
                }
            }
            $field = $field . "</fieldset>";
        }
    }

    return $field;
}



/*--- Brands/Manufacturers ---*/
function outputSearchBrandListAsDropdownList($inputName = '', $width = '')
{
    $brandManager = new ManufacturerManager();
    $brandsList = $brandManager->getBrandList();
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    $field = $field . "<option value='0'> All Brands/Manufacturers</option>";
    if (sizeof($brandsList) > 0) {
        $brand = new Manufacturer();
        foreach ($brandsList as $brand) {

            if ($defaultSelectValue == $brand->get_manufacturer_id()) {
                $field = $field . "<option  selected='selected' value='" . $brand->get_manufacturer_id() . "'>" . $brand->get_manufacturer_name() . "</option>";
            } else {
                $field = $field . "<option value='" . $brand->get_manufacturer_id() . "'>" . $brand->get_manufacturer_name() . "</option>";
            }
        }
    }
    $field = $field . "</select>";

    return $field;
}

function outputBrandsListAsDropdownList($inputName = '', $width = '', $defaultSelectValue = '')
{
    $brandManager = new ManufacturerManager();
    $brandsList = $brandManager->getBrandList();
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    if (sizeof($brandsList) > 0) {
        $brand = new Manufacturer();
        foreach ($brandsList as $brand) {

            if ($defaultSelectValue == $brand->get_manufacturer_id()) {
                $field = $field . "<option  selected='selected' value='" . $brand->get_manufacturer_id() . "'>" . $brand->get_manufacturer_name() . "</option>";
            } else {
                $field = $field . "<option value='" . $brand->get_manufacturer_id() . "'>" . $brand->get_manufacturer_name() . "</option>";
            }
        }
    } else {
        $field = $field . "<option value='0'>No value defined</option>";
    }
    $field = $field . "</select>";

    return $field;
}

/*--- ShippingRegionList ---*/
function outputShippingRegionListAsDropdownList($inputName = '', $width = '', $defaultSelectValue = '')
{
    $shippingManager = new ShippingManager();
    $shippingRegionList = $shippingManager->getShippingRegionList();
    $field = "<select name='" . $inputName . "' style='width:" . $width . "px' >";
    if (sizeof($shippingRegionList) > 0) {
        $shippingRegion = new ShippingRegion();
        foreach ($shippingRegionList as $shippingRegion) {

            if ($defaultSelectValue == $shippingRegion->get_shipping_region_id()) {
                $field = $field . "<option  selected='selected' value='" . $shippingRegion->get_shipping_region_id() . "'>" . $shippingRegion->get_shipping_region() . "</option>";
            } else {
                $field = $field . "<option value='" . $shippingRegion->get_shipping_region_id() . "'>" . $shippingRegion->get_shipping_region() . "</option>";
            }
        }
    } else {
        $field = $field . "<option value='0'>No value defined</option>";
    }
    $field = $field . "</select>";

    return $field;
}

/*--- output for website  ---*/

function outputProductAsBlock($product, $configManager, $language_id = 1)
{
    $productImage = new ProductImage();
    $productImageManager = new ProductImageManager();
    $productImageManager->set_product_id($product->get_product_id());
    $ProductImage = $productImageManager->get_default_product_image();
    $ProductImage->set_product_image_path($configManager->getValueByKey("product_image_path"));

    $onsale_price = "";
    if ($product->get_product_presale_price_if_onale() != "") {
        $onsale_price = outputPriceWithCurrency($configManager, $product->get_product_presale_price_if_onale());
    }
    $price = outputPriceWithCurrency($configManager, $product->get_product_price());


    $field = "";
    $field = $field . "
        <div class='product_block'>
	<span class='product_block_title'>
	<a href='index.php?view=product_detail&product_id=" . $product->get_product_id() . "'>" . $product->getProductDescriptionByLanguageID($language_id)->get_product_name() . "</a>
	</span>";

    if ($configManager->getValueByKey("show_review") == "Y") {
        $uni_id = uniqid();
        $field = $field . "<div class='product_block_rating_box'>";
        $field = $field . outputStarRatingReadOnly($product->getProductAverageRating(), $uni_id);
        $field = $field . "</div>";
    }

    $field = $field . "<div class='product_image_thumbnail'>" . $ProductImage->outputProductImage("", "", "", "product_block_thumbnail") . "</div>";
    $field = $field . "
        <div class='price_box'>
        <span class='product_price_onsale'>" . $onsale_price . "</span>
        <span class='product_price'>" . $price . "</span>
        </div>";
    $field = $field . "
	<div class='gray_button_box'><a href='index.php?view=product_detail&product_id=" . $product->get_product_id() . "'>Product Detail</a></div>
	<div class='blue_button_box'><a  href='process/shopping_cart_add_process.php?quantity=1&product_id=" . $product->get_product_id() . "'>Add to Cart</a></div>";
    $field = $field . "</div>";
    return $field;
}

function outputStarRatingReadOnly($rating, $uni_id)
{
    $field = "";
    for ($counter = 1;
         $counter <= 5;
         $counter += 1) {
        if (
            $rating == $counter
        ) {
            $field = $field . "<input class='star' type='radio' name='" . $uni_id . "' value='" . $counter . "' checked='true'/>";
        } else {
            $field = $field . "<input class='star' type='radio' name='" . $uni_id . "' value='" . $counter . "' disabled='disabled'/>";
        }
    }
    return $field;
}

function outputStarRating($uni_id)
{
    $field = "";
    for ($counter = 1;
         $counter <= 5;
         $counter += 1) {
        $field = $field . "<input class='star' type='radio' name='" . $uni_id . "' value='" . $counter . "' checked='true'/>";
    }
    return $field;
}


function outputShippingMethodRadioButtonsGroupTable($configManager)
{
    $field = "<table width='600'  cellpadding='5' cellspacing='0' class='table_style'>
              <tr>
                <td width='200' align='center'>Shipping Method</td>
                <td width='100' align='center'>Cost</td>
                <td width='300' align='center'>Shipping Region</td>
              </tr>";


    $shippingManager = new ShippingManager();
    $shippingMethodList = $shippingManager->getShippingList();
    $count = 0;
    if (sizeof($shippingMethodList) > 0 && $shippingMethodList != null) {
        foreach ($shippingMethodList as $shipping) {
//$shipping = new Shipping();

            $cost = outputPriceWithCurrency($configManager, $shipping->get_shipping_cost());
            if ($count == 0) {
                $field = $field . "<tr><td><input type='radio' name='shipping_id' value='" . $shipping->get_shipping_id() . "' checked>
                " . $shipping->get_shipping_type() . " </td>
                <td> " . $cost . " </td><td> " . $shipping->get_shipping_region()->get_shipping_region() . "</td></tr>";
            } else {
                $field = $field . "<tr><td><input type='radio' name='shipping_id' value='" . $shipping->get_shipping_id() . "'>
                " . $shipping->get_shipping_type() . " </td>
                <td> " . $cost . " </td><td> " . $shipping->get_shipping_region()->get_shipping_region() . "</td></tr>";
            }
            $count++;
        }
    }

    $field = $field . "</table>";
    return $field;
}

function outputShippingMethodsAsTable($configManager)
{
    $field = "<table width='600'  cellpadding='5' cellspacing='0' class='table_style'>
              <tr>
                <td width='200' align='center'><b>Shipping Method</b></td>
                <td width='100' align='center'><b>Cost</b></td>
                <td width='300' align='center'><b>Shipping Region</b></td>
              </tr>";


    $shippingManager = new ShippingManager();
    $shippingMethodList = $shippingManager->getShippingList();

    if (sizeof($shippingMethodList) > 0 && $shippingMethodList != null) {
        foreach ($shippingMethodList as $shipping) {
//$shipping = new Shipping();
            $cost = outputPriceWithCurrency($configManager, $shipping->get_shipping_cost());
            $field = $field . "<tr><td>" . $shipping->get_shipping_type() . " </td>
                <td> " . $cost . " </td><td> " . $shipping->get_shipping_region()->get_shipping_region() . "</td></tr>";
        }
    }

    $field = $field . "</table>";
    return $field;
}

function outputPaymentMethodRadioButtonsGroupTable($configManager)
{
    $field = "<table width='600' border='0'  cellpadding='3' cellspacing='3'>";


    $paymentMethodManager = new PaymentMethodManager();
    $paymentMethodList = $paymentMethodManager->loadPaymentMethodList();
    $count = 0;
    if (sizeof($paymentMethodList) > 0 && $paymentMethodList != null) {
        foreach ($paymentMethodList as $paymentMethod) {
            if ($count == 0) {
                $field = $field . "<tr valign='middle' ><td align='left' width='20'><input type='radio' name='payment_method_id' value='" . $paymentMethod->get_payment_method_id() . "' checked></td>
                <td>" . $paymentMethod->get_payment_method_logo_as_image("110", "40", $configManager->getValueByKey("domain_name")) . " </td></tr>";
            } else {
                $field = $field . "<tr valign='middle' ><td align='left' width='20'><input type='radio' name='payment_method_id' value='" . $paymentMethod->get_payment_method_id() . "' ></td>
                <td>" . $paymentMethod->get_payment_method_logo_as_image("110", "40", $configManager->getValueByKey("domain_name")) . " </td></tr>";
            }
            $count++;
        }
    }

    $field = $field . "</table>";
    return $field;
}

function outputPriceWithCurrency($configManager, $price)
{
    $field = $configManager->getValueByKey("currency_sign") . " " . number_format($price, 2, '.', ',');
    return $field;
}


function outputNewsletterCheckbox($newsletter, $input_name)
{
    $field = "";
    if ($newsletter == "Y") {
        $field = "<input type='checkbox' name='$input_name' id='$input_name' checked='true'>";
    } else {
        $field = "<input type='checkbox' name='$input_name' id='$input_name' checked='false'>";
    }
    return $field;
}


function outputCategoryAsLinkList($categoryList)
{
    $field = "<ul>";
    if ($categoryList != null) {
        if (sizeof($categoryList) > 0) {
            foreach ($categoryList as $category) {
                $field = $field . "<li><a href='index.php?view=product_by_category&id=" . $category->get_category_id() . "'>
                        " . $category->get_category_name() . "</a>";
                if ($category->get_category_children_list() != null) {
                    if (sizeof($category->get_category_children_list()) > 0) {
                        $field = $field . outputCategoryAsLinkList($category->get_category_children_list());
                    }
                }
                $field = $field . "</li>";
            }
        }
    }
    $field = $field . "</ul>";
    return $field;
}


function outputLanguageOtpionURL($PHP_SELF, $QUERY_STRING)
{
    $field = "";
    $languageManager = new LanguageManager();
    $languageList = $languageManager->getLanguageList();
    if (sizeof($languageList) > 1) {
        $field = "&nbsp;&nbsp;&nbsp;";
        foreach ($languageList as $language) {
            $field = $field . "<a href='" . $PHP_SELF;
            if ($QUERY_STRING == null) {
                $field = $field . "?language_id=" . $language->get_language_id() . "'>" . $language->get_language_icon_as_image_for_site() . "</a>  ";
            } else {
                //remove the prevous language id from the url
                $key = "language_id"; // ket to remove
                parse_str($QUERY_STRING, $ar);
                $QUERY_STRING = http_build_query(array_diff_key($ar, array($key => ""))); //get the new url without language_id

                $field = $field . "?language_id=" . $language->get_language_id() . "&" . $QUERY_STRING . "'>" . $language->get_language_icon_as_image_for_site() . "</a>  ";
            }
        }
    }
    return $field;
}
?>
