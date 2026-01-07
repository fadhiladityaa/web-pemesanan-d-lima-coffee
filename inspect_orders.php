<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$result = \Illuminate\Support\Facades\DB::select("SELECT sql FROM sqlite_master WHERE type='table' AND name='orders'");
print_r($result);
