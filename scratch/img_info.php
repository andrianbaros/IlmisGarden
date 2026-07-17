<?php
$imgs = ['img/bouquet.png', 'img/box.png', 'img/basket.png', 'img/standing.png', 'img/vase.png', 'img/ArtisanProductmenu.png'];
foreach ($imgs as $i) {
    if (file_exists($i)) {
        $info = getimagesize($i);
        echo "$i: {$info[0]}x{$info[1]}\n";
    } else {
        echo "$i: NOT FOUND\n";
    }
}
