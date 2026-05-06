<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=u757590993_inv3", "u757590993_inv3", "p&6PV6#nw&Vf");
    echo "Connected successfully\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
