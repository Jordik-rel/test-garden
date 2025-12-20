<?php

use App\Models\Jardinier;
use App\Models\Projet;
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
        Schema::create('avis_particuliers', function (Blueprint $table) {
            $table->id();
            $table->integer('note');
            $table->text('commentaire');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Jardinier::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('avis_particuliers');
    }
};
