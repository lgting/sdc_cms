<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('parent_id')->nullable()->comment(trans('menus.parent_id'));
            $table->unsignedInteger('sortable')->nullable()->comment(trans('menus.sortable'));
            $table->string('title',40)->nullable()->comment(trans('menus.title'));
            $table->string('icon',120)->nullable()->comment(trans('menus.icon'));
            $table->string('uri',191)->nullable()->comment(trans('menus.uri'));
            $table->string('permission',191)->nullable()->comment(trans('menus.permission'));
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
        Schema::dropIfExists('menus');
    }
}
