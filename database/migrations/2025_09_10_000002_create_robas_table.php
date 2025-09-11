<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('robas', function (Blueprint $table) {
            $table->bigIncrements('roba_id');
            $table->string('naziv');
            $table->string('sifra');
            $table->string('opis');
            $table->integer('kolicina');
            $table->string('lokacija');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robas');
    }
};
