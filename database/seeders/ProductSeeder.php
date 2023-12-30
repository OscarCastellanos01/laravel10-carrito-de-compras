<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Uid\UuidV1;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'code' => 'A00001',
            'description' => 'Primer producto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'code' => 'A00002',
            'description' => 'Segundo producto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        DB::table('products')->insert([
            'code' => 'A00003',
            'description' => 'Tercer prudcto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'code' => 'A00004',
            'description' => 'Cuarto producto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'code' => 'A00005',
            'description' => 'Quinto producto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'code' => 'A00006',
            'description' => 'Sexto producto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'code' => 'A00007',
            'description' => 'Septimo producto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'code' => 'A00008',
            'description' => 'Octavo producto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'code' => 'A00009',
            'description' => 'Noveno producto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'code' => 'A00010',
            'description' => 'Decimo producto',
            'price' => 2.5,
            'stock' => 100,
            'img_url' => 'oepto-iqkeo-emdiq' . '.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
