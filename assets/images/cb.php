<?php
require_once('cbC128.php');
$code = new codeBarreC128($_GET['code']);
$code->setTitle();
$code->setFramedTitle(true);
$code->setHeight(70);
$code->Output();
exit();
