<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::create([
    'username' => 'admin',
    'email' => 'admin@admin.com',
    'password' => Hash::make('Admin@123456'),
    'level' => 'admin',
    'status' => 'active',
    'limit_device' => 999,
    'chunk_blast' => 100,
    'active_subscription' => true,
]);

echo "Admin user created successfully!\n";
echo "Username: admin\n";
echo "Email: admin@admin.com\n";
echo "Password: Admin@123456\n";
