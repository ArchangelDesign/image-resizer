<?php

require_once '../autoload.php';

$resizer = new ArchangelDesign\ImageResizer('test-file.jpg');
$resizer->avatar(__DIR__ . '/avatar.jpg', 200);

$r2 = new ArchangelDesign\ImageResizer('vertical.jpg');
$r2->avatar(__DIR__ . '/avatar-vertical.jpg', 100);