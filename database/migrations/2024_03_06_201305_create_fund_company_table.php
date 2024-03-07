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
        Schema::create('fund_company', function (Blueprint $table) {
            $table->foreignId('fund_id')->constrained('funds');
            $table->foreignId('company_id')->constrained('companies');
            $table->unique(['fund_id', 'company_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_company');
    }
};
