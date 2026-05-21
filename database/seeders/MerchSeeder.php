<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class MerchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CREATE CAP
        Item::factory()->create([
            'sku' => 'KFC-001',
            'item_name' => 'Knight Flight Cap',
            'description' => 'Embroidered hat with adjustable strap.',
            'image_url' => '/storage/merch/knight-flight-cap.jpg',
            'price' => 18.00,
            'weight_oz' => 6.40, // 0.4 lb × 16
            'quantity_in_stock' => 50,
            'active' => true,
        ]);

        // CREATE SHIRT
        Item::factory()->create([
            'sku' => 'PS-001',
            'item_name' => 'Pilot Shirt',
            'description' => 'Branded shirt with breathable fabric.',
            'image_url' => '/storage/merch/pilot-shirt.jpg',
            'price' => 35.00,
            'weight_oz' => 12.80, // 0.8 lb × 16
            'quantity_in_stock' => 50,
            'active' => true,
        ]);

        // CREATE MUG
        Item::factory()->create([
            'sku' => 'TM-001',
            'item_name' => 'Travel Mug',
            'description' => 'Insulated mug for hot or cold drinks.',
            'image_url' => '/storage/merch/travel-mug.jpg',
            'price' => 22.00,
            'weight_oz' => 9.60, // 0.6 lb × 16
            'quantity_in_stock' => 50,
            'active' => true,
        ]);
    }
}
