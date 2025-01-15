<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';
$targetFramework = get_target_framework();
echo json_encode(
    [
        'framework' => $targetFramework,
    ]
);