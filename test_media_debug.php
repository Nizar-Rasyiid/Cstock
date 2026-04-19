<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap/app.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Load Product model
$product = \Modules\Product\Entities\Product::find(10);

if ($product) {
    echo "Product: " . $product->product_name . "\n";
    echo "Has Media: " . ($product->hasMedia('images') ? 'YES' : 'NO') . "\n";
    
    $mediaUrl = $product->getFirstMediaUrl('images');
    echo "getFirstMediaUrl('images'): " . ($mediaUrl ?: 'EMPTY/NULL') . "\n";
    
    $media = $product->getFirstMedia('images');
    if ($media) {
        echo "Media ID: " . $media->id . "\n";
        echo "Media File Name: " . $media->file_name . "\n";
        echo "Media Disk: " . $media->disk . "\n";
        echo "Media Conversions: " . json_encode($media->getGeneratedConversions()) . "\n";
    } else {
        echo "NO MEDIA FOUND\n";
    }
} else {
    echo "Product not found\n";
}
