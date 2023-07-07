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
        Schema::create('accounts', function(Blueprint $table){
            $table -> id('id');
            $table -> float('cash', 20, 2)->nullable();
            $table -> unsignedBigInteger('users_id');
            $table -> index('users_id', 'user_account_idx');
            $table -> foreign('users_id', 'user_account_fk')->on('users')->references('id');
            $table -> timestamps();
            $table -> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
