<?php
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$users = App\Models\User::all();
foreach ($users as $u) {
    $u->username = $u->email;
    $u->save();
}
echo "DONE";
