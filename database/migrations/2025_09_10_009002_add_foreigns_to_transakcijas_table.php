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
        Schema::table('transakcijas', function (Blueprint $table) {
            $table
                ->foreign('zaposleni_id')
                ->references('zaposleni_id')
                ->on('zaposlenis')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('roba_id')
                ->references('roba_id')
                ->on('robas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transakcijas', function (Blueprint $table) {
            $table->dropForeign(['zaposleni_id']);
            $table->dropForeign(['roba_id']);
        });
    }
};
