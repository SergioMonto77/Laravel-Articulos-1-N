<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, Article};
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //===============================================>crearé 1 usuario manualmente (seeder) y 9 aleatorios (factory)
        $this->call(UserSeeder::class);

        User::factory(9)->create();


        //===============================================>borraré y crearé de nuevo la carpeta 'articulos' (borrando las imágenes del disco)
        Storage::deleteDirectory('articles');
        Storage::makeDirectory('articles');


        //===============================================>crearé 100 articulos aleatoriamente
        Article::factory(100)->create();

    }
}
