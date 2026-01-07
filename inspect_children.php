<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Tables referencing 'cart':\n";
$carts = \Illuminate\Support\Facades\DB::select("SELECT name, sql FROM sqlite_master WHERE sql LIKE '%REFERENCES%cart%'");
print_r($carts);

echo "\nTables referencing 'orders':\n";
$orders = \Illuminate\Support\Facades\DB::select("SELECT name, sql FROM sqlite_master WHERE sql LIKE '%REFERENCES%orders%'");
print_r($orders);
