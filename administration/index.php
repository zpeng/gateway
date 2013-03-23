<?php
require_once('admin_authentication.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gemini E-Shop</title>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <link rel="stylesheet" type="text/css" href="styles/top_menu_styles.css" />
        <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.7.1.custom/css/custom-theme/jquery-ui-1.8.2.custom.css" />
        <script type="text/javascript" src="js/jquery-ui-1.7.1.custom/js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.7.1.custom/js/jquery-ui-1.7.1.custom.min.js"></script>
        <script type="text/javascript" src='js/admin_form_validation.js' ></script>
        <script type="text/javascript" src='js/accordion.js' ></script>
    </head>

    <body>
        <div class="main_body">
            <div class="top_bar">
                <span class="product_title">Gemini E-Shop</span>
                <span class="product_title_version">version 1.0</span>

                <div class="top_bar_nav">
                    <a href='../index.php'>Website</a>&nbsp;|&nbsp;
                    <a href='index.php?view=admin_cp'>Administration Home</a>&nbsp;|&nbsp;
                    <a href='admin_logout.php'>Logout</a>
                </div>
            </div>

            <? include 'top_menu.php';?>

            <div class="main_view">
                <?
                // get the view parameter from the url
                $view = secureRequestParameter($_REQUEST["view"]);

                switch ($view) {
                    case "admin_cp" :
                        include_once 'view/admin_cp.php';
                        break;
                    case "admin_admin_list" :
                        include_once 'view/admin_admin_list.php';
                        break;
                    case "admin_admin_password_update" :
                        include_once 'view/admin_admin_password_update.php';
                        break;
                    case "admin_category_list" :
                        include_once 'view/admin_category_list.php';
                        break;
                    case "admin_category_update" :
                        include_once 'view/admin_category_update.php';
                        break;
                    case "admin_category_add_sub" :
                        include_once 'view/admin_category_add_sub.php';
                        break;
                    case "admin_brand_list" :
                        include_once 'view/admin_brand_list.php';
                        break;
                    case "admin_brand_update" :
                        include_once 'view/admin_brand_update.php';
                        break;

                    case "admin_attribute_list" :
                        include_once 'view/admin_attribute_list.php';
                        break;
                    case "admin_attribute_update" :
                        include_once 'view/admin_attribute_update.php';
                        break;
                    case "admin_attribute_value_list" :
                        include_once 'view/admin_attribute_value_list.php';
                        break;
                    case "admin_attribute_value_update" :
                        include_once 'view/admin_attribute_value_update.php';
                        break;


                    case "admin_language_list" :
                        include_once 'view/admin_language_list.php';
                        break;

                    case "admin_product_list" :
                        include_once 'view/admin_product_list.php';
                        break;
                    case "admin_product_update" :
                        include_once 'view/admin_product_update.php';
                        break;
                    case "admin_configuration" :
                        include_once 'view/admin_configuration.php';
                        break;
                    case "admin_customer_list" :
                        include_once 'view/admin_customer_list.php';
                        break;
                    case "admin_customer_update" :
                        include_once 'view/admin_customer_update.php';
                        break;

                    case "admin_content_add" :
                        include_once 'view/admin_content_add.php';
                        break;
                    case "admin_content_list" :
                        include_once 'view/admin_content_list.php';
                        break;
                    case "admin_content_update" :
                        include_once 'view/admin_content_update.php';
                        break;
                    case "admin_menu_list" :
                        include_once 'view/admin_menu_list.php';
                        break;
                    case "admin_menu_update" :
                        include_once 'view/admin_menu_update.php';
                        break;
                    case "admin_menu_add" :
                        include_once 'view/admin_menu_add.php';
                        break;
                    

                    case "admin_shipping_region_list" :
                        include_once 'view/admin_shipping_region_list.php';
                        break;

                    case "admin_shipping_region_update" :
                        include_once 'view/admin_shipping_region_update.php';
                        break;

                    case "admin_shipping_list" :
                        include_once 'view/admin_shipping_list.php';
                        break;
                    case "admin_shipping_update" :
                        include_once 'view/admin_shipping_update.php';
                        break;

                    case "admin_email_template_list" :
                        include_once 'view/admin_email_template_list.php';
                        break;
                    case "admin_email_template_update" :
                        include_once 'view/admin_email_template_update.php';
                        break;

                    case "admin_payment_method_list" :
                        include_once 'view/admin_payment_method_list.php';
                        break;
                    case "admin_payment_method_update" :
                        include_once 'view/admin_payment_method_update.php';
                        break;

                    case "admin_order_list" :
                        include_once 'view/admin_order_list.php';
                        break;
                    case "admin_order_update" :
                        include_once 'view/admin_order_update.php';
                        break;

                    default :
                        include_once 'view/admin_cp.php';
                }

                ?>
            </div>


            <div class="footer">
                <br/>
                &copy; 2009 Ring of Software Engineers
                <br/>
            </div>
        </div>

    </body>
</html>
