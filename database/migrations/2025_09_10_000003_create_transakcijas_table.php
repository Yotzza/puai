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
        Schema::create('transakcijas', function (Blueprint $table) {
            $table->bigIncrements('transakcija_id');
            $table->foreignId('zaposleni_id');
            $table->foreignId('roba_id');
            $table->integer('kolicina');
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
        Schema::dropIfExists('transakcijas');
    }
};
