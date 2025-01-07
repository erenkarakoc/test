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
            $table->id();
            $table->string('tnx_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ref_user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('type', ['deposit', 'withdraw', 'invest', 'earned', 'referral_bonus']);
            $table->decimal('amount_in_asset')->nullable();
            $table->decimal('amount_in_usd');
            $table->string('asset')->nullable();
            $table->decimal('asset_price')->nullable();
            $table->decimal('asset_balance_after')->nullable();
            $table->decimal('asset_locked_balance_after')->nullable();
            $table->decimal('total_balance_after')->nullable();
            $table->decimal('total_locked_balance_after')->nullable();
            $table->foreignId('strategy_pack_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('status', ['completed', 'pending', 'cancelled', 'rejected']);
            $table->string('note')->nullable();
            $table->string('hash_id')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
