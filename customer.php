<?
include_once 'session.php';
require_once('included/class_loader.php');
require_once('included/html_functions.php');

//is not logged in, redirect to login page
if (!$s_cart->get_customer_login()) {
    header("Location: index.php?view=customer_login");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- saved from url=(0042)http://osc.template-help.com/drupal_27726/ -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr" class="cufon-active cufon-ready">
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
                            <!-- List -->
                            <? include_once 'view/left_c_customer_menu.php'; ?>
                        </td >

                        <td width="10">

                        </td>

                        <td width="700" valign="top">

                                                       <!-- start main content -->
                            <?
                            $view = secureRequestParameter($_REQUEST["view"]);

                              switch ($view) {
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
                              include_once 'view/customer_order_history.php';
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