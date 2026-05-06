<?php
echo "PHP is working!\n";
echo "PHP Version: " . phpversion() . "\n";

// Test Laravel bootstrap
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
echo "Laravel bootstrap successful!\n";

// Test database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=u757590993_inv3", "u757590993_inv3", "p&6PV6#nw&Vf");
    echo "Database connection successful!\n";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
}
