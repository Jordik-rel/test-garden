<?php

use App\Models\Competence;
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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            // $table->text('livrable')->nullable();
            $table->string('support')->nullable();
            $table->enum('taille_poste',[1,2,3]);
            $table->enum('niveau_experience',[1,2,3]);
            $table->enum('type_emploi',[0,1]);
            $table->enum('duree',[1,2,3,4]);
            $table->enum('tarif_type',[0,1]);
            $table->integer('tarif_min')->default(0);
            $table->integer('tarif_max')->default(0);
            $table->integer('budget')->default(0);
            $table->enum('status',[1,2,3,4,5,6]); // 1:En attente , 2: En cours , 3: Terminé , 4: Attribué , 5: Fini par le jardinier , 6: En attente de validaion client
            $table->string('localisation')->nullable();
            $table->boolean('is_Public')->default(true);
            $table->boolean('is_Post')->default(false);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->softDeletes();

            // $table->enum('calendrier_embauche',[1,2,3,4])->nullable();
            // $table->enum('horaire_hebdomadaire',[1,2,3]);
            // $table->date('date_limite_projet')->nullable();
            // $table->foreignIdFor(Competence::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
