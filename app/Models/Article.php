<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Article extends Model
{
    use HasFactory;

    //atr que se van a poder manipular
    protected $fillable= ['nombre', 'slug', 'descripcion', 'precio', 'stock', 'imagen', 'user_id'];

    //función para poder implementar el slug
    public function getRouteKeyName(){
        return 'slug';
    }

    //relación 1:N
    public function user(){
        return $this->belongsTo(User::class);
    }
}
