<? include_once 'session.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title><?= $s_configManager->getValueByKey("shop_name") ?></title>
        <meta name="description" content="<?= $s_configManager->getValueByKey("meta_description") ?>" />
        <meta name="keywords" content="<?= $s_configManager->getValueByKey("meta_keywords") ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="google-site-verification" content="070mgamASMthsmidqWjJboR1p3cKJQiMF7mzGXD44s0" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/top_menu_style.css"/>
        <link rel="stylesheet" type="text/css" href="css/left_menu_style.css"/>
        <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.2.custom/css/custom-theme/jquery-ui-1.8.2.custom.css" />
        <script type="text/javascript" src="js/jquery-ui-1.8.2.custom/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.2.custom/js/jquery-ui-1.8.2.custom.min.js"></script>
        <script type="text/javascript" src='js/validation.js' ></script>
        <script type="text/javascript" src="js/thumbnailviewer.js" defer="defer"></script>
        <script src='js/rating/jquery.rating.js' type="text/javascript" language="javascript"></script>
        <link href='js/rating/jquery.rating.css' type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <center>
            <!-- top header -->
            <? include_once 'top_header.php'; ?>

            <!-- top menu -->
            <? include_once 'top_menu.php'; ?>

            <div class="main_body">
                <table border="0" cellpadding="0" cellspacing="0" width="950" style="margin: 0">
                    <tr>
                        <td width="240" valign="top">
                            <!-- category list -->
                            <!-- there is no category box for this website -->
                            <? //include_once 'view/left_c_category_list.php'; ?>


                            <!-- client panel -->
                            <?
                            if (!$s_cart->get_customer_login()) {
                                include_once 'view/left_c_customer_login_panel.php';
                            } else {
                                include_once 'view/left_c_customer_menu.php';
                            }
                            ?>

                            <br />
                            <!-- popular items -->
                            <? include_once 'view/left_c_popular_items.php'; ?>

                        </td >

                        <td width="10">

                        </td>

                        <td width="700" valign="top">

                            <!-- start main content -->
                            <?
                            // get the view parameter from the url
                            $view = secureRequestParameter($_REQUEST["view"]);

                            switch ($view) {
                                case "main_page" :
                                    include_once 'view/main_page.php';
                                    break;
                                case "content" :
                                    include_once 'view/content.php';
                                    break;
                                case "product_detail" :
                                    include_once 'view/product_detail.php';
                                    break;
                                case "product_by_category" :
                                    include_once 'view/product_by_category.php';
                                    break;
                                case "product_onsale" :
                                    include_once 'view/product_onsale.php';
                                    break;
                                case "customer_login" :
                                    include_once 'view/customer_login.php';
                                    break;
                                case "customer_register" :
                                    include_once 'view/customer_register.php';
                                    break;
                                case "customer_retrieve_password" :
                                    include_once 'view/customer_retrieve_password.php';
                                    break;
                                case "product_search" :
                                    include_once 'view/product_search.php';
                                    break;
                                case "shopping_cart" :
                                    include_once 'view/shopping_cart.php';
                                    break;

                                case "customer_order_history" :
                                    include_once 'view/customer_order_history.php';
                                    break;
                                case "customer_order_detail" :
                                    include_once 'view/customer_order_detail.php';
                                    break;
                                case "customer_address_update" :
                                    include_once 'view/customer_address_update.php';
                                    break;
                                case "customer_detail_update" :
                                    include_once 'view/customer_detail_update.php';
                                    break;
                                case "customer_password_update" :
                                    include_once 'view/customer_password_update.php';
                                    break;

                                case "customer_shipping_method_confirm" :
                                    include_once 'view/customer_shipping_method_confirm.php';
                                    break;
                                case "customer_order_confirm" :
                                    include_once 'view/customer_order_confirm.php';
                                    break;
                                case "customer_order_done" :
                                    include_once 'view/customer_order_done.php';
                                    break;
                                default :
                                    include_once 'view/main_page.php';
                            }
                            ?>
                            <!-- End of Right Conlumn -->


                        </td>
                    </tr>
                </table>
            </div>

            <!-- footer -->
            <? include_once 'footer.php'; ?>

        </center>
    </body>
</html>