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
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('personal_income_tax')->notnull()->default(20);
            $table->tinyInteger('age_line')->notnull()->default(50);
            $table->tinyInteger('age_tax')->notnull()->default(7);
            $table->tinyInteger('children_line')->notnull()->default(2);
            $table->tinyInteger('children_tax')->notnull()->default(2);
            $table->decimal('car_rent', 10, 2)->notnull();
            $table->string('currency_name', 3)->notnull()->default('РУБ');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameters');
    }
};
