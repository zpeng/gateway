<?php

require_once('../external/php/Eden-3.1/eden.php');

eden()->setLoader(true);

$smtp = eden('mail')->smtp('auth.smtp.1and1.co.uk', 'admin@dealsteal.co', '19840617', 25);

$smtp->setSubject('Welcome!')
    ->setBody('<p>Hello you!</p>', true)
    ->setBody('Hello you!')
    ->addTo('pengziyang@gmail.com')
    ->send();

$smtp->disconnect();

?>