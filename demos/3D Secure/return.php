<?php
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);
include('../../vendor/autoload.php');

// Create instance of Direct
$sagepay = new dwmsw\sagepay\Direct();
$sagepay->setConnectionMode('test');
$output = $sagepay->threeDResponse($_POST['MD'], $_POST['PaRes']);

print '<h1>RESPONSE</h1>';
var_dump($output);