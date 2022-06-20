<?php
require_once('../vendor/autoload.php');

use Payeer\Trade\Trade;

$trade = new Trade();

print_r($trade->Info('BTC_RUB'));

