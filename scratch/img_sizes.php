<?php
function list_images($dir) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($files as $file) {
        if ($file->isFile() && in_array(strtolower($file->getExtension()), ['png', 'jpg', 'jpeg'])) {
            $path = $file->getPathname();
            $size = round($file->getSize() / 1024); // KB
            $dimensions = "Unknown";
            try {
                $info = getimagesize($path);
                if ($info) {
                    $dimensions = "{$info[0]}x{$info[1]}";
                }
            } catch (Exception $e) {}
            if ($size > 100) { // Only show images larger than 100KB
                echo "$path: {$size} KB - {$dimensions}\n";
            }
        }
    }
}
list_images('img');
