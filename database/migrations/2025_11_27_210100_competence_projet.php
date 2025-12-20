<?php

use App\Models\Competence;
use App\Models\Projet;
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
        Schema::create('competence_projet', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Competence::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Projet::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('competence_projet');
        Schema::enableForeignKeyConstraints();
    }
};
