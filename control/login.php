<?php
require_once('../includes/bootstrap.php');

use modules\deal_steal\includes\classes\Client;
use modules\deal_steal\includes\classes\ClientManager;

$email = secureRequestParameter($_REQUEST['email']);
$password = secureRequestParameter($_REQUEST['password']);

$clientManager = new ClientManager();
$result = $clientManager->login($email, $password);

if ($result) {
    session_start();

    $client = new Client();
    $client->loadByEmail($email);

    $_SESSION['client_name'] = $client->getFullName();
    $_SESSION['client_id'] = $client->getClientId();
    $_SESSION['client_email'] = $email;
    $_SESSION['client_is_login'] = $result;

    header("Location: " . SERVER_URL . "index.php");

} else {
    header("Location: " . SERVER_URL . "index.php?view=login&error=Wrong username or password!");
}
?>
