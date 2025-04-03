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
        // Товары
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manufacturer_id')->constrained('manufacturers')->cascadeOnDelete();
            $table->foreignId('fuel_id')->constrained('fuels')->cascadeOnDelete();
            $table->foreignId('voltage_id')->constrained('voltages')->cascadeOnDelete();
            $table->foreignId('execution_id')->constrained('executions')->cascadeOnDelete();
            $table->foreignId('automation_id')->constrained('automations')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            // Основые поля
            $table->string('title')->comment('Название');
            $table->string('description')->nullable()->comment('Описание');
            $table->json('image')->nullable()->comment('Изображение');
            // Цена
            $table->decimal('price_rub', 12, 2)->nullable()->comment('Цена в рублях');
            $table->decimal('price_usd', 12, 2)->nullable()->comment('Цена в долларах');
            // Технические характеристики
            $table->decimal('nominal_power', 12, 2)->nullable()->comment('Номинальная мощность генератора');
            $table->string('model')->nullable()->comment('Модель электростанции');
            $table->string('start_type')->nullable()->comment('Тип запуска');
            $table->string('engine_type')->nullable()->comment('Двигатель');
            $table->string('engine_model')->nullable()->comment('Модель двигателя');
            $table->decimal('engine_volume', 8, 2)->nullable()->comment('Объем двигателя');
            $table->string('cooling_type')->nullable()->comment('Охлаждение');
            $table->integer('engine_rpm')->nullable()->comment('Обороты двигателя');
            $table->decimal('ng_consumption_50', 8, 2)->nullable()->comment('Расход NG при 50% мощности');
            $table->decimal('ng_consumption_100', 8, 2)->nullable()->comment('Расход NG при 100% мощности');
            $table->decimal('ng_pressure', 8, 2)->nullable()->comment('Давление газа NG');
            $table->string('phase_type')->nullable()->comment('Тип фазности');
            $table->string('generator_type')->nullable()->comment('Тип электрогенератора');
            $table->string('dimensions')->nullable()->comment('Габариты');
            $table->decimal('weight', 8, 2)->nullable()->comment('Масса');
            $table->string('country')->nullable()->comment('Страна производства');
            $table->json('equipment')->nullable()->comment('Комплектация');
            // is active
            $table->boolean('is_active')->default(true)->comment('отображать на сайте');
            $table->boolean('is_popular')->default(false)->comment('отображать в разделе "популярное"');
            $table->boolean('is_banner')->default(false)->comment('отображать в баннере');
            // meta
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
