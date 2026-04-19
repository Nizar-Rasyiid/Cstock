<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Product\Entities\Product;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateProductQRCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qrcode:generate {--product-id= : Generate QR code for specific product}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Generate QR codes untuk semua produk atau produk tertentu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $productId = $this->option('product-id');

        if ($productId) {
            $product = Product::find($productId);
            if (!$product) {
                $this->error("Produk dengan ID {$productId} tidak ditemukan!");
                return 1;
            }
            $this->generateQRForProduct($product);
        } else {
            $products = Product::all();
            $this->info("Generating QR codes untuk {$products->count()} produk...");
            
            foreach ($products as $product) {
                $this->generateQRForProduct($product);
            }
            
            $this->info("✅ QR codes berhasil di-generate!");
        }

        return 0;
    }

    private function generateQRForProduct($product)
    {
        // Format QR code URL
        $qrUrl = url("/qr/{$product->product_code}");
        
        // Path untuk simpan QR code
        $qrPath = storage_path("app/qrcodes/{$product->id}.svg");
        
        // Buat directory jika belum ada
        if (!is_dir(storage_path("app/qrcodes"))) {
            mkdir(storage_path("app/qrcodes"), 0755, true);
        }

        // Generate QR code
        QrCode::size(300)
            ->format('svg')
            ->generate($qrUrl, $qrPath);

        $this->line("✓ QR code untuk {$product->product_code} ({$product->product_name}) di-generate");
    }
}
