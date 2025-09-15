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
        Schema::create('cryptos', function (Blueprint $table) {
                $table->id();
                $table->string('symbol');      // BTC, ETH, etc.
                $table->string('name');        // Bitcoin, Ethereum...
                $table->decimal('price', 20, 8);
                $table->decimal('percent_change_24h', 10, 4);
                $table->decimal('volume_24h', 20, 4);
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cryptos');
    }
};
