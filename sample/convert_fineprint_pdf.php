<?php
require_once('../includes/bootstrap.php');

use modules\deal_steal\includes\classes\Deal;

$deal = new Deal();
$deal->loadById(2);

$mpdf=new mPDF();
$mpdf->WriteHTML($deal->getFinePrint());
$mpdf->Output();
exit;


?>