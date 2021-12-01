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
            $table->integer('episodes');
            $table->text('status');
            $table->foreignId('licensors')->constrained('licensors');
            $table->json('genres');
            $table->decimal('rating');
            $table->text('season');
            $table->text('type');
            $table->foreignId('producers')->constrained('producers');
            $table->foreignId('studios')->constrained('studios');
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
