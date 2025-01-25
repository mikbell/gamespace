<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->string('game_slug'); // Per identificare il gioco preso dall'API
            $table->unsignedTinyInteger('rating'); // Valore di valutazione (1-5)
            $table->unsignedBigInteger('user_id'); // Collegamento all'utente che ha valutato
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }

};
