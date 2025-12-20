<?php

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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('compagny');
            $table->string('nomPoste');
            $table->string('ville');
            $table->string('pays');
            $table->string('duree');
            $table->text('description')->nullable();
            $table->string('attestation')->nullable();
            $table->foreignIdFor(Jardinier::class)->nullable()->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
