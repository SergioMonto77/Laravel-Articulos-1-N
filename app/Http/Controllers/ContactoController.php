<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMailable;

class ContactoController extends Controller
{
    
    public function pintarFormulario(){
        return view('contacto.form');
    }

    public function procesarFormulario(Request $request){

        //validamos los datos
        $request->validate([
            'nombre'=> ['required', 'string', 'min:3'],
            'email'=> ['nullable', 'email'], //será nullable debido a que si no introduce email se cogerá auto. el email del usuario autenticado
            'contenido'=> ['required', 'string', 'min:10']
        ]);

        //una vez validados los datos envio el email y redirijo
        try{
            Mail::to('adminarticles@gmail.com')->send(new ContactoMailable($request->all()));
            return redirect()->route('dashboard')->with('mensaje', 'Correo enviado');
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('dashboard')->with('mensaje', 'No se ha podido enviar en este momento');
        }
    }

}
