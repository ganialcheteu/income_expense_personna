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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('amount');
            $table->date('payment_date');
            $table->string('slug')->unique();
            $table->foreignId('activity_id')->default(null)->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreignId('supplier_id')->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreignId('expense_type_id')->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreignId('expense_category_id')->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
