<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('episodes');
            $table->text('status');
            $table->foreignId('licensor')->constrained('licensors');
            $table->json('genres');
            $table->decimal('rating', places: 2);
            $table->text('season');
            $table->text('type');
            $table->foreignId('producer')->constrained('producers');
            $table->foreignId('studio')->constrained('studios');
            $table->text('image');
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
        Schema::dropIfExists('animes');
    }
}
