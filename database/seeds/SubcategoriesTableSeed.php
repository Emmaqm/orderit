<?php

use Carbon\Carbon;
use App\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoriesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = Carbon::now()->toDateTimeString();
        
        Subcategory::insert([
            ['nombre' => 'Golosinas y Chocolates', 'nom_low' => 'golosinas_chocolates', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Galletas', 'nom_low' => 'galletas', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Copetín', 'nom_low' => 'copetin', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Conservas', 'nom_low' => 'conservas', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Salsas', 'nom_low' => 'salsas', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Pizzas y tapas', 'nom_low' => 'pizzas', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Pastas', 'nom_low' => 'pastas', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Especias y sazonadores', 'nom_low' => 'especias', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Cereales y semillas', 'nom_low' => 'cereales', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Dulces y mermeladas', 'nom_low' => 'mermeladas', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Infusiones', 'nom_low' => 'infusiones', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Café, cebada y cocoa', 'nom_low' => 'cafe', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Aceites y vinagres', 'nom_low' => 'aceites', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Preparados para postres', 'nom_low' => 'para_postres', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Arroz y legumbres', 'nom_low' => 'arroz', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Harina, levaduras y puré', 'nom_low' => 'harina', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Caldos y sopas', 'nom_low' => 'sopas', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Yerba', 'nom_low' => 'yerba', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Azúcar y edulcorantes', 'nom_low' => 'azucar', 'category_id' => '1', 'created_at' => $now, 'updated_at' => $now],
        
        ]);
    }
}
