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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->decimal('montant', 12, 2);
            $table->string('capture_du_paiement');
            $table->string('methode_de_paiement');
            $table->string('player_id');
            $table->foreignIdFor(User::class)->nullable()
            ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(FreeFireCard::class)->nullable()
            ->constrained()->cascadeOnDelete();
            $table->enum('status', ['en attente', 'validé', 'echoué'])
            ->default('en attente');
            $table->timestamps();
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
