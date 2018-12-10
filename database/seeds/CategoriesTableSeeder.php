<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Category $category)
    {
        $category->create(['name'=>'Deportes','description'=>'Accesorios de Beisbol y Futbol']);
        $category->create(['name'=>'Ropa','description'=>'Camisas, Pantalones y Zapatos']);
        $category->create(['name'=>'Tecnologia','description'=>'Telefonos, Tablets, Laptops, Computadoras, Televisores y Equipos de Sonido']);
        $category->create(['name'=>'VideoJuegos','description'=>'Consolas y Juegos para Ps4, XboxOne y Nintendo Switch']);

    }
}



