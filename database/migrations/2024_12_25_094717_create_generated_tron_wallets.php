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
        Schema::create('generated_tron_wallets', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('tnx_id');
            $table->decimal('trx_balance');
            $table->decimal('usdt_balance');
            $table->decimal('amount_in_usd');
            $table->decimal('asset_price');
            $table->string('private_key');
            $table->string('public_key');
            $table->string('address_hex');
            $table->string('address_base58');
            $table->enum('status', ['generated', 'received-balance', 'paid-user', 'sent-balance']);
            $table->string('hash_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated_tron_wallets');
    }
};
