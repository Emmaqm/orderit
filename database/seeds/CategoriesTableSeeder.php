<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        
        Category::insert([
            ['nombre' => 'Almacén', 'nom_low' => 'almacen', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Frescos', 'nom_low' => 'frescos', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Bebidas', 'nom_low' => 'bebidas', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Congelados', 'nom_low' => 'congelados', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Perfumería', 'nom_low' => 'perfumeria', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Limpieza', 'nom_low' => 'limpieza', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
