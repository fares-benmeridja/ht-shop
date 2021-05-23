<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

const PATH = 'categories';
const FILE_PATH = __DIR__.DIRECTORY_SEPARATOR.PATH.DIRECTORY_SEPARATOR;

return [
    [
        'name'  => "Laptops",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."laptop.jpg"),
        'icon'  => "fa fa-laptop",
        'slug'  => Str::slug('laptops')
    ],
    [
        'name'  => "Printers & Scanners",
        'image' => Storage::disk('public')->putFile(PATH,  FILE_PATH."printer.jpg"),
        "icon"  => "fa fa-print",
        'slug'  => Str::slug('printers and scanners')
    ],
    [
        'name'  => "Desktop Computer parts",
        'image' => Storage::disk('public')->putFile(PATH,   FILE_PATH."desktop-parts.jpg"),
        "icon"  => "fa fa-camera",
        'slug'  => Str::slug('desktop computer parts')
    ],
    [
        'name'  => "Computers Accessories",
        'image' => Storage::disk('public')->putFile(PATH,   FILE_PATH."accessories.jpg"),
        "icon"  => "fa fa-keyboard-o",
        'slug'  => Str::slug('computers accessories')
    ],
    [
        'name'  => "Network",
        'image' => Storage::disk('public')->putFile(PATH,   FILE_PATH."network.jpg"),
        'icon'  => 'fa fa-sitemap',
        'slug'  => Str::slug('network')
    ],
    [
        'name'  => "Desktop PCs",
        'image' => Storage::disk('public')->putFile(PATH,   FILE_PATH."desktop-pcs.jpg"),
        "icon"  => 'fa fa-desktop',
        'slug'  => Str::slug('desktop pcs')
    ],
    [
        'name'  => "Laptop parts",
        'image' => Storage::disk('public')->putFile(PATH,   FILE_PATH."laptop-parts.jpg"),
        "icon"  => "fa fa-battery-half",
        'slug'  => Str::slug('laptop parts')
    ],
    [
        'name'  => "External storage",
        'image' => Storage::disk('public')->putFile(PATH,   FILE_PATH."external-storage.jpg"),
        "icon"  => "fa fa-hdd-o",
        'slug'  => Str::slug('external storage')
    ],
];
