<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles= Article::orderBy('id', 'desc')->where('user_id', auth()->user()->id)->paginate(5);
        return view('dashboard', compact('articles')); //le paso a mi vista todos los articulos para el usuario autenticado ordenados desc. y paginados 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validamos los campos que nos llegan del formulario
        $request->validate([
            'nombre'=> ['required', 'string', 'min:3', 'unique:articles,nombre'],
            'descripcion'=> ['required', 'string', 'min:10'],
            'precio'=> ['required', 'numeric', 'min:0', 'max:999,99'],
            'stock'=> ['required', 'numeric', 'min:0', 'max:10000'],
            'imagen'=> ['required', 'image', 'max:2048'] //máx 2MB (TIPO IMAGE)  ==>es required ya que debe subir una foto del artículo (A DIFERENCIA DEL UPDATE)
        ]);

        //si todo ha ido bien guardamos la imagen en disco, creamos el registro y redirigimos. EOC mostramos los errores
        $img= $request->imagen->store('articles'); //guardo en disco la imagen con ->store (indicándole la carpeta (articles)) y almaceno en 'img' articles/nombre.png

        Article::create([
            'nombre'=> $request->nombre,
            'slug'=> Str::slug($request->nombre),
            'descripcion'=> $request->descripcion,
            'precio'=> $request->precio,
            'stock'=> $request->stock,
            'imagen'=> $img,
            'user_id'=> auth()->user()->id //el id corresponderá al del usuario autenticado
        ]);

        return redirect()->route('dashboard')->with('mensaje', 'Articulo creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    //he decidido crear un método show el cual usaré para las vistas dashboard y welcome (sin estar autenticado en ambas, ya que será el mismo)
    //no usaré por tanto el show que viene por defecto (ya que necesitaría estar autenticado y al no servirme tendría que implementar 2 show diferentes)
    public function showNoAuth(Article $article)
    {
        return view('articles.showNoAuth', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //validamos los campos que nos llegan del formulario
        $request->validate([
            'nombre'=> ['required', 'string', 'min:3', 'unique:articles,nombre,'.$article->id], //el título debe ser único (obviando el suyo)
            'descripcion'=> ['required', 'string', 'min:10'],
            'precio'=> ['required', 'numeric', 'min:0', 'max:999,99'],
            'stock'=> ['required', 'numeric', 'min:0', 'max:10000'],
            'imagen'=> ['nullable', 'image', 'max:2048'] //máx 2MB (TIPO IMAGE) ==>es nullable debido a que puede querer actualizar la que tenía o no
        ]);


        //si todo ha ido bien guardamos la imagen en disco, actualizamos el registro y redirigimos. EOC mostramos los errores
        $img= ($request->imagen) ? $request->imagen->store('articles') : $article->imagen; //$img valdrá la ruta de la nueva imagen si se ha subido (Y SE GUARDARÁ EN DISCO) o la ruta de la img anterior si no hay nueva

        if($request->imagen){
            Storage::delete($article->imagen); //si se ha subido nueva imagen borraré la anterior
        }

        $article->update([
            'nombre'=> $request->nombre,
            'slug'=> Str::slug($request->nombre),
            'descripcion'=> $request->descripcion,
            'precio'=> $request->precio,
            'stock'=> $request->stock,
            'imagen'=> $img,
            'user_id'=> auth()->user()->id //el id corresponderá al del usuario autenticado
        ]);

        return redirect()->route('dashboard')->with('mensaje', 'Articulo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //borro la imagen del artículo del disco
        Storage::delete($article->imagen);

        //borro el artículo y redirijo
        $article->delete();
        return redirect()->route('dashboard')->with('mensaje', 'Post Eliminado');
    }
}

