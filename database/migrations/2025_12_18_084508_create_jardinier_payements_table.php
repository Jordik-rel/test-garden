<?php

use App\Models\Jardinier;
use App\Models\Mission;
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
        Schema::create('jardinier_payements', function (Blueprint $table) {
            $table->id();
            $table->string('numero_admin');
            $table->string('numero_jardinier');
            $table->string('reference');
            $table->string('transaction_id');
            $table->string('montant');
            $table->foreignIdFor(Jardinier::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Mission::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jardinier_payements');
    }
};
