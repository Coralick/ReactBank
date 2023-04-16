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
        Schema::create('account', function(Blueprint $table){
            $table -> id('id');
            $table -> integer('cash')->nullable();
            $table -> unsignedBigInteger('user_id');
            $table -> index('user_id', 'user_account_idx');
            $table -> foreign('user_id', 'user_account_fk')->on('users')->references('id');
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
