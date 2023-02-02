<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('slug')->unique(); //el slug va a ser de tipo string Y SIEMPRE HA DE SER UNICO
            $table->text('descripcion');
            $table->decimal('precio', 5, 2);
            $table->integer('stock');
            $table->string('imagen'); //la imagen es de tipo string (ya que en la db guardaremos la ruta para acceder a ella)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
