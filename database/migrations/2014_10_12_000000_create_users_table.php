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
            $table->id();
            $table->string('usr_name');
            $table->string('usr_email')->unique();
            $table->timestamp('usr_email_verified_at')->nullable();
            $table->string('usr_password');
            $table->string('usr_shp_name')->nullable();
            $table->string('usr_phone')->nullable();
            $table->string('usr_address')->nullable();
            $table->string('usr_img')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
