<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function(Blueprint $table){
            $table -> id('id');
            $table -> float('sum', 20, 2)->nullable();
            $table -> unsignedBigInteger('users_id');
            $table -> index('users_id', 'users_loans_idx');
            $table -> foreign('users_id', 'users_loans_fk')->on('users')->references('id');
            $table -> timestamps();
            $table -> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
