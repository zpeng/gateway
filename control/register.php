<?php
require_once('../includes/bootstrap.php');

use modules\deal_steal\includes\classes\Client;
use modules\deal_steal\includes\classes\ClientManager;

$email = secureRequestParameter($_REQUEST['email']);
$password = secureRequestParameter($_REQUEST['password']);
$title = secureRequestParameter($_REQUEST['title']);
$surname = secureRequestParameter($_REQUEST['surname']);
$firstname = secureRequestParameter($_REQUEST['firstname']);
$dob = secureRequestParameter($_REQUEST['dob']);
$tel = secureRequestParameter($_REQUEST['tel']);
$mobile = secureRequestParameter($_REQUEST['mobile']);
if (isset($_REQUEST['subscribed']) && $_REQUEST['subscribed'] == "Y") {
    $subscribed = "Y";
} else {
    $subscribed = "N";
}

$clientManager = new ClientManager();

if ($clientManager->checkClientExistsByEmail($email)) {
    // the email exits
    header("Location: " . SERVER_URL . "index.php?view=login&error=The email has been used already. Please try to use another email to
    register or retrieve your password via 'forget your password' link below");

} else {

    $client = new Client();
    $client->setClientEmail($email);
    $client->setClientPassword(md5($password));
    $client->setClientTitle($title);
    $client->setClientSurname($surname);
    $client->setClientFirstname($firstname);
    $client->setClientDob($dob);
    $client->setClientTel($tel);
    $client->setClientMobile($mobile);
    $client->setSubscribed($subscribed);
    $client->insert();

    header("Location: " . SERVER_URL . "index.php?view=login&info=Thank you for joining with us! Please login and enjoy the deals.");
}


?>