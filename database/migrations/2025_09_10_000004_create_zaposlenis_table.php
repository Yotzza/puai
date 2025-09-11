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
        Schema::create('zaposlenis', function (Blueprint $table) {
            $table->bigIncrements('zaposleni_id');
            $table->string('ime');
            $table->string('prezime');
            $table->string('username');
            $table->string('password');
            $table->string('uloga', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zaposlenis');
    }
};
