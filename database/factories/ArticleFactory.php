<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $nombre= ucfirst($this->faker->words(random_int(2,4), true)); //almaceno el nombre en una variable para poder hacer el slug del mismo nombre generado ale.

        $this->faker->addProvider(new \Mmo\Faker\PicsumProvider($this->faker)); //hago referencia al provider de la librería implementada de imágenes

        return [
            'nombre'=> $nombre,
            'slug'=> Str::slug($nombre),
            'descripcion'=> $this->faker->text(),
            'precio'=> $this->faker->randomFloat(2, 0, 999), //el máx. será 999,99
            'stock'=> random_int(0, 1000),
            'user_id'=> User::all()->random()->id,
            'imagen'=> 'articles/'.$this->faker->picsum('public/storage/articles' ,640, 480, null, false)
        ];

        /*en mi db almacenaré 'articulos/nombre.png'
        el parám. null indica categ. ale.
        el parám. false indica que solo devolverá el nombre de la img (no la ruta completa)
        el 1er parám. indica la ruta en disco para guardar la imagen (guardo en enlace simbólico)*/
    }
}
