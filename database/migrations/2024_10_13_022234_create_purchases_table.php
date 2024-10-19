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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suppliers')->constrained();
            $table->string('date');
            $table->string('purchase_no');
            $table->tinyInteger('status')->default(0)->comment('0=Pending, 1=Approved');
            $table->integer('total_amount');
            $table->foreignId('users')->constrained()->cascadeOnDelete();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
