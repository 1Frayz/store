<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalFieldsTable extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_fields', function (Blueprint $table) {
            $table->id();
            $table->string('external_code');
            $table->foreign('external_code')->references('external_code')->on('products')->onDelete('cascade');
            $table->string('name');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('brand')->nullable();
            $table->string('composition')->nullable();
            $table->integer('quantity_per_pack')->nullable();
            $table->string('packaging_link')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_h1')->nullable();
            $table->text('seo_description')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('length')->nullable();
            $table->integer('packaging_weight')->nullable();
            $table->integer('packaging_width')->nullable();
            $table->integer('packaging_height')->nullable();
            $table->integer('packaging_length')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_fields');
    }
}
