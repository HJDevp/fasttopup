<?php

use App\Models\Descriptions;
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
        Schema::create('free_fire_cards', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('quantite_diamons');
            $table->string('chemin_image');
            $table->decimal('prix', 8, 2);
            $table->foreignIdFor(Descriptions::class)->nullable()->constrained()->cascadeOnDelete();
            $table->enum('promotion', ['en vente', 'reduction', 'gratuit'])->default('en vente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_fire_cards');
        Schema::table('free_fire_cards', function(Blueprint $table ){
            $table->dropForeignIdFor(Descriptions::class);
        });
    }
};
