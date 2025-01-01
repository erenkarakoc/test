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
        Schema::create('strategies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('min_invest', 10, 2);
            $table->decimal('max_invest', 10, 2);
            $table->decimal('profit_percentage_min', 5, 2);
            $table->decimal('profit_percentage_max', 5, 2);
            $table->integer('period');
            $table->integer('repeat_time');
            $table->timestamp('start_at')->useCurrent();
            $table->timestamp('end_at')->nullable();
            $table->json('ref_bonuses')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategies');
    }
};
