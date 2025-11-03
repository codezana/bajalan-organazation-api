<?php

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
        Schema::create('accounting', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('amount_received', 20, 0);
            $table->string('address_received');
            $table->float('amount_paid', 20, 0);
            $table->string('address_paid');
            $table->float('balance', 20, 0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('accounting');
    }
};
