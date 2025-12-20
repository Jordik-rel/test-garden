<?php

use App\Models\Competence;
use App\Models\Jardinier;
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
        Schema::create('competence_jardinier', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Jardinier::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Competence::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('competence_jardinier');
        Schema::enableForeignKeyConstraints();
    }
};
