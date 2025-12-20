<?php

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
        Schema::create('propositions', function (Blueprint $table) {
            $table->id();
            $table->integer('tarif_propose');
            $table->enum('duree',[1,2,3,4]);
            $table->text('message');
            $table->json('support')->nullable();
            $table->enum('status',[1,2,3])->default(1); // 1: En attente , 2: Accepté , 3: Refusé
            $table->foreignIdFor(Projet::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propositions');
    }
};
