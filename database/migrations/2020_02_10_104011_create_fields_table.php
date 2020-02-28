<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('model_id')->nullable()->comment(__('fields.model id'));
            $table->string('zh_name',60)->nullable()->comment(__('fields.zh name'));
            $table->string('en_name',60)->nullable()->comment(__('fields.en name'));
            $table->unsignedTinyInteger('type')->nullable()->comment(__('fields.type'));
            $table->text('values')->nullable()->comment(__('fields.values'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
}
