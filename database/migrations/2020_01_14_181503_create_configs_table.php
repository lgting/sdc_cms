<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zh_name',65)->nullable()->comment(__('configs.zh_name'));
            $table->string('en_name',65)->nullable()->comment(__('configs.en_name'));
            $table->text('value')->nullable()->comment(__('configs.value'));
            $table->string('values',190)->nullable()->comment(__('configs.values'));
            $table->unsignedTinyInteger('data_type')->default(0)->comment(__('configs.data_type'));
            $table->unsignedTinyInteger('config_type')->default(0)->comment(__('configs.config_type'));
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
        Schema::dropIfExists('configs');
    }
}
