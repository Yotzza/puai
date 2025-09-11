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
        Schema::create('izvestajs', function (Blueprint $table) {
            $table->bigIncrements('izvestaj_id');
            $table->foreignId('zaposleni_id');
            $table->string('opis');
            $table->date('datum');
            $table->string('tip');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izvestajs');
    }
};
