<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->boolean('occupied')->default(false);
            $table->integer('row');
            $table->integer('column');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
