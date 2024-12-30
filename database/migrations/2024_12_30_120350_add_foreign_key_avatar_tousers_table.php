<?php
use App\Models\Avatars;
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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Avatars::class)->after('remember_token')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimez d'abord la contrainte de clé étrangère
            $table->dropForeign(['avatars_id']); 
    
            // Supprimez ensuite la colonne associée
            $table->dropColumn('avatars_id');
        });
    }

};
