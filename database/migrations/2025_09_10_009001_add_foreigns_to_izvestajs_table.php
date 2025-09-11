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
        Schema::table('izvestajs', function (Blueprint $table) {
            $table
                ->foreign('zaposleni_id')
                ->references('zaposleni_id')
                ->on('zaposlenis')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('izvestajs', function (Blueprint $table) {
            $table->dropForeign(['zaposleni_id']);
        });
    }
};
