<?php

use App\Models\FreeFireCard;
use App\Models\User;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()
            ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(FreeFireCard::class)->nullable()
            ->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->enum('status', ['en cours', 'reussi', 'échoué', 'remboursé'])
            ->default('en cours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
