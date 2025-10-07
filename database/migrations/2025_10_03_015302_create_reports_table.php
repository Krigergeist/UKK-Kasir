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
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('rpt_id');
            $table->unsignedBigInteger('rpt_usr_id');
            $table->date('rpt_date');
            $table->tinyInteger('rpt_month'); // 1-12
            $table->year('rpt_year');
            $table->unsignedBigInteger('rpt_created_by')->nullable();
            $table->unsignedBigInteger('rpt_updated_by')->nullable();
            $table->unsignedBigInteger('rpt_deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
