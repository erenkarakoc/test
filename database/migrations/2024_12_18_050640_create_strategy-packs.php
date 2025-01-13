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
        Schema::create('strategy_packs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->json('algorithms');
            $table->decimal('total_contribution_rate');
            $table->decimal('daily_income_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategy_packs');
    }
};
