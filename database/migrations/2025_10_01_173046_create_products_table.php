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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('prd_id');
            $table->unsignedBigInteger('prd_usr_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('prd_code');
            $table->string('prd_name');
            $table->integer('prd_price');
            $table->integer('prd_stock');
            $table->text('prd_description')->nullable();
            $table->string('prd_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
