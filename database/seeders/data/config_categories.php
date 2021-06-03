<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

const PATH = 'config_categories';
const FILE_PATH = __DIR__.DIRECTORY_SEPARATOR.PATH.DIRECTORY_SEPARATOR;

return [
    [
        'name'  => "Processor",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."cpu.png"),
        'icon'  => "fa fa-microchip",
        'slug'  => Str::slug('processors')
    ],
    [
        'name'  => "Graphic card",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."gpu.png"),
        'icon'  => "fa fa-microchip",
        'slug'  => Str::slug('graphic card')
    ],
    [
        'name'  => "RAM",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."ram.png"),
        'icon'  => null,
        'slug'  => Str::slug('ram')
    ],
    [
        'name'  => "Motherboard",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."motherboard.png"),
        'icon'  => null,
        'slug'  => Str::slug('motherboard')
    ],
    [
        'name'  => "Power supply unit",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."psu.png"),
        'icon'  => null,
        'slug'  => Str::slug('power supply unit')
    ],
    [
        'name'  => "SSD",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."ssd.png"),
        'icon'  => "fa fa-hdd-o",
        'slug'  => Str::slug('ssd')
    ],
    [
        'name'  => "HDD",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."hdd.png"),
        'icon'  => "fa fa-hdd-o",
        'slug'  => Str::slug('hard disc')
    ],
    [
        'name'  => "Boitier",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."boitier.png"),
        'icon'  => null,
        'slug'  => Str::slug('boitier')
    ],
    [
        'name'  => "Network card",
        'image' => Storage::disk('public')->putFile(PATH, FILE_PATH."network-card.png"),
        'icon'  => null,
        'slug'  => Str::slug('network card')
    ],
];
