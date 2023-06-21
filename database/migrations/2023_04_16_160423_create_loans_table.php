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
            $table -> integer('period')->nullable();
            $table -> integer('sum')->nullable();
            $table -> unsignedBigInteger('user_id');
            $table -> index('user_id', 'user_loans_idx');
            $table -> foreign('user_id', 'user_loans_fk')->on('users')->references('id');
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
