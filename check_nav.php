<?php
$output = [];
$dirs = ['.', 'notuser', 'includes'];
foreach($dirs as $dir) {
    $files = glob($dir . '/*.php');
    foreach($files as $file) {
        $content = file_get_contents($file);
        if (preg_match('/<nav|<header/i', $content)) {
            $output[] = $file;
        }
    }
}
echo "FILES WITH NAV/HEADER:\n";
echo implode("\n", $output);
