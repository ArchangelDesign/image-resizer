<?php

require_once '../autoload.php';

$resizer = new ArchangelDesign\ImageResizer('test-file.jpg');
$resizer->avatar(__DIR__ . '/avatar.jpg', 200);

$r2 = new ArchangelDesign\ImageResizer('vertical.jpg');
$r2->avatar(__DIR__ . '/avatar-vertical.jpg', 100);

$r2->simpleResize(100, 100, \ArchangelDesign\ImageResizer::RESIZE_MODE_MAINTAIN_HEIGHT, __DIR__ . '/simple-resized.jpg');