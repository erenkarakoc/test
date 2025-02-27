<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('locked_packs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('strategy_pack_id')->nullable()->constrained('strategy_packs');
            $table->json('chosen_algorithms');
            $table->decimal('amount', 18, 8);
            $table->integer('period');
            $table->decimal('algorithms_cost', 18, 8);
            $table->decimal('estimated_profit_rate', 18, 8);
            $table->enum('status', ['executing', 'completed', 'cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('locked_packs');
    }
};
