<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('column_id')->comment(__('articles.column id'));
            $table->unsignedInteger('model_id')->comment(__('articles.model id'));
            $table->string('title',120)->nullable()->comment(__('articles.title'));
            $table->string('keywords')->nullable()->comment(__('articles.keywords'));
            $table->text('description')->nullable()->comment(__('articles.description'));
            $table->longText('content')->nullable()->comment(__('articles.content'));
            $table->string('author',60)->nullable()->comment(__('articles.author'));
            $table->string('source',60)->nullable()->comment(__('articles.source'));
            $table->string('thumb')->nullable()->comment(__('articles.thumb'));
            $table->string('attributes',60)->nullable()->comment(__('articles.attributes'));
            $table->unsignedInteger('clicks')->default(0)->comment(__('articles.clicks'));
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
        Schema::dropIfExists('articles');
    }
}
