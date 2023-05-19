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
        Schema::create('users', function (Blueprint $table) {
            $table -> id();
            $table -> char('name', 35);
            $table -> char('lastname',35)->nullable();
            $table -> char('phoneNumber',15)->nullable();
            $table -> char('email',100);
            $table -> timestamp('email_verified_at')->nullable();
            $table -> string('password')->nullable();
            $table -> rememberToken();
            $table -> timestamps();
            $table -> softDeletes();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
