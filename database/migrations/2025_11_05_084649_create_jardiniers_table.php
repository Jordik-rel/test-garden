<?php

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
        Schema::create('jardiniers', function (Blueprint $table) {
            $table->id();
            $table->string('profession');
            // $table->string('experience');
            $table->text('description');
            // $table->array('certifications')->nullable();
            $table->double('tarif_horaire');
            $table->double('tarif_journalier');
            $table->boolean('disponible')->default(false);
            $table->double('note_moyenne')->default(0);
            $table->integer('nombre_missions')->default(0);
            $table->string('site_web')->nullable();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('jardiniers');
        Schema::enableForeignKeyConstraints();
    }
};
