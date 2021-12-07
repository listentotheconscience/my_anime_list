<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMangasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mangas', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('image');
            $table->integer('chapters');
            $table->json('genres');
            $table->decimal('rating', places: 2);
            $table->integer('year');
            $table->text('type');
            $table->text('status');
            $table->foreignId('mangaka')->constrained('mangakas');
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
        Schema::dropIfExists('mangas');
    }
}
