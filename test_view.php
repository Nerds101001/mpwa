<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

echo "Theme name: " . env('THEME_NAME') . "\n";
echo "Theme index: " . env('THEME_INDEX') . "\n";

// Test view paths
$viewFinder = app('view')->getFinder();
echo "View paths:\n";
foreach ($viewFinder->getPaths() as $path) {
    echo "  - $path\n";
}

// Check if home view exists
try {
    $viewPath = $viewFinder->find('home');
    echo "\nHome view found at: $viewPath\n";
} catch (Exception $e) {
    echo "\nHome view NOT found: " . $e->getMessage() . "\n";
}

// List theme directory
echo "\nTheme directory contents:\n";
$themeDir = base_path('resources/themes/vuexy/views');
if (is_dir($themeDir)) {
    echo "Directory exists: $themeDir\n";
    $files = scandir($themeDir);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            echo "  - $file\n";
        }
    }
} else {
    echo "Directory does NOT exist: $themeDir\n";
}
