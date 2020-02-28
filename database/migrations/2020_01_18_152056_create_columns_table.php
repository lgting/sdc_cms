<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable()->comment(__('columns.parent_id'));
            $table->string('name',80)->nullable()->comment(__('columns.name'));
            $table->unsignedTinyInteger('status')->comment(__('columns.status'));
            $table->string('image',191)->nullable()->comment(__('columns.image'));
            $table->unsignedTinyInteger('attributes')->nullable()->comment(__('columns.attributes'));
            $table->string('channel_template',120)->nullable()->comment(__('columns.channel_template'));
            $table->string('list_template',120)->nullable()->comment(__('columns.list_template'));
            $table->string('content_template',120)->nullable()->comment(__('columns.content_template'));
            $table->string('seo_title',80)->nullable()->comment(__('columns.seo_title'));
            $table->string('seo_keywords',191)->nullable()->comment(__('columns.seo_keywords'));
            $table->text('seo_description')->nullable()->comment(__('columns.seo_description'));
            $table->text('content')->nullable()->comment(__('columns.content'));
            $table->unsignedInteger('sortable')->default(0)->comment(__('columns.sortable'));
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
        Schema::dropIfExists('columns');
    }
}
