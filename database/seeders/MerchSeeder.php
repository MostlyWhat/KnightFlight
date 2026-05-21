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
            'image_url' => 'https://images.unsplash.com/photo-1571587783275-e516087c502c?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
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
            'image_url' => 'https://plus.unsplash.com/premium_photo-1683134205839-4034616645d6?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
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
            'image_url' => 'https://images.unsplash.com/photo-1555447014-7ead71574544?q=80&w=736&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'price' => 22.00,
            'weight_oz' => 9.60, // 0.6 lb × 16
            'quantity_in_stock' => 50,
            'active' => true,
        ]);
    }
}
