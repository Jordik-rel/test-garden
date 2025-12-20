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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('nomEcole');
            $table->string('ville');
            $table->string('pays');
            $table->date('dateDebut');
            $table->date('dateFin')->nullable();
            $table->string('niveauetude');
            $table->string('domaine');
            $table->string('nomFormation');
            $table->text('description')->nullable();
            $table->foreignIdFor(Jardinier::class)->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
