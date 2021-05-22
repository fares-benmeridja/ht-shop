<?php

const PATH = 'categories';

return [
    [
        'name'  => "Men's Clothing & Shoes",
        'image' => PATH.DIRECTORY_SEPARATOR."cat-men.jpeg",
        'slug'  => \Illuminate\Support\Str::slug("Men's Clothing & Shoes")
    ],
    [
        'name'  => "Women's Clothing & Shoes",
        'image' => PATH.DIRECTORY_SEPARATOR."cat-women.jpeg",
        'slug'  => \Illuminate\Support\Str::slug("Women's Clothing & Shoes")
    ],
    [
        'name'  => "Baby & Kids",
        'image' => PATH.DIRECTORY_SEPARATOR."cat-kids.jpeg",
        'slug'  => \Illuminate\Support\Str::slug("Baby & Kids")
    ],
    [
        'name'  => "Jewelry & Accessories",
        'image' => PATH.DIRECTORY_SEPARATOR."cat-acc.jpeg",
        'slug'  => \Illuminate\Support\Str::slug("Jewelry & Accessories")
    ],
    [
        'name'  => "Bags & Luggage",
        'image' => PATH.DIRECTORY_SEPARATOR."cat-bags.jpeg",
        'slug'  => \Illuminate\Support\Str::slug("Bags & Luggage")
    ],
    [
        'name'  => "Toys",
        'image' => PATH.DIRECTORY_SEPARATOR."cat-toys.jpeg",
        'slug'  => \Illuminate\Support\Str::slug("Toys")
    ],
    [
        'name'  => "Tools",
        'image' => PATH.DIRECTORY_SEPARATOR."tools.jpg",
        'slug'  => \Illuminate\Support\Str::slug("Tools")
    ],
    [
        'name'  => "Furniture",
        'image' => PATH.DIRECTORY_SEPARATOR."furniture.jpg",
        'slug'  => \Illuminate\Support\Str::slug("Furniture")
    ],
    [
        'name'  => "Art",
        'image' => PATH.DIRECTORY_SEPARATOR."art.png",
        'slug'  => \Illuminate\Support\Str::slug("Art")
    ],
    [
        'name'  => "Books",
        'image' => PATH.DIRECTORY_SEPARATOR."books.jpg",
        'slug'  => \Illuminate\Support\Str::slug("Books")
    ],
    [
        'name'  => "Others",
        'image' => PATH.DIRECTORY_SEPARATOR."other.jpg",
        'slug'  => \Illuminate\Support\Str::slug("Others")
    ],

];