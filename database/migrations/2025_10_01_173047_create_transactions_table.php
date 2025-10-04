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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('tsn_id');
            $table->unsignedBigInteger('tsn_usr_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('tsn_csm_name');
            $table->string('tsn_date');
            $table->enum('tsn_metode', ['cash', 'credit', 'debit']);
            $table->decimal('tsn_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
