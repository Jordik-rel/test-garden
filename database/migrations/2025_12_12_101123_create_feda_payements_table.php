<?php

use App\Models\Mission;
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
        Schema::create('feda_payements', function (Blueprint $table) {
            $table->id();
            $table->string('numero_recu'); // transaction_key
            $table->string('reference');
            // $table->string('moyen_payement'); // id payement method
            $table->string('montant');
            $table->string('status');
            $table->string('numero_payement'); // id du numéro
            $table->date('date');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Mission::class)->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feda_payements');
    }
};
