<?php
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$u = App\Models\User::where("email", "whatsapp@enginerds.in")->first();
if ($u) {
    $u->password = Illuminate\Support\Facades\Hash::make("admin");
    $u->save();
    echo "DONE";
} else {
    echo "USER NOT FOUND";
}
