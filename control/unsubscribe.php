<?php

require_once('../includes/bootstrap.php');
use modules\deal_steal\includes\classes\NewsletterSubscribeManager;

$email = $_REQUEST['email'];
$nsm = new NewsletterSubscribeManager();
$nsm->unsubscribe($email);

header("Location: " . SERVER_URL . "index.php?view=unsubscribe");

?>