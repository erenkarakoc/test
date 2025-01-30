<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
      $table->enum('type', ['received', 'sent', 'locked', 'earned', 'bonus']);
      $table->decimal('amount_in_asset', 16, 8)->nullable();
      $table->decimal('amount_in_usd', 16, 8);
      $table->string('asset')->nullable();
      $table->decimal('asset_price', 16, 8)->nullable();
      $table->decimal('asset_balance_after', 16, 8)->nullable();
      $table->decimal('asset_locked_balance_after', 16, 8)->nullable();
      $table->decimal('total_balance_after', 16, 8)->nullable();
      $table->decimal('total_locked_balance_after', 16, 8)->nullable();
      $table->foreignId('strategy_pack_id')->nullable()->constrained()->onDelete('cascade');
      $table->enum('status', ['completed', 'pending', 'cancelled', 'rejected']);
      $table->json('notes')->nullable();
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
