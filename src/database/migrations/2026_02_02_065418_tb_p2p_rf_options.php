<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        // Option A: Running a single raw statement
        DB::statement("
            
        ");
    }

    public function down(): void {
        // You still need to define how to undo it
        DB::statement("DROP TABLE IF EXISTS p2p.");
    }
};
