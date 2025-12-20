<?php

use App\Models\Plant;
use App\Models\ValeurNutritionnelle;
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
        Schema::create('plant_valeur_nutritionnelle', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ValeurNutritionnelle::class)->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('plant_valeur_nutritionnelle');
        Schema::enableForeignKeyConstraints();
    }
};
