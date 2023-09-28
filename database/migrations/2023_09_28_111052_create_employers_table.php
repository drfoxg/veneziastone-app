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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->notnull();
            $table->integer('age')->notnull();
            $table->tinyInteger('is_car')->notnull()->default(0);
            $table->tinyInteger('children')->notnull()->default(0);
            $table->decimal('salary', 10, 2)->notnull();
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
        Schema::dropIfExists('employers');
    }
};
