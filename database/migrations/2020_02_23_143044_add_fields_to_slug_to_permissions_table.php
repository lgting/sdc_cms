<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSlugToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('slug')->nullable()->comment(__('permissions.slug'))->after('guard_name');
            $table->string('http_methods')->nullable()->comment(__('permissions.http methods'))->after('slug');
            $table->text('http_paths')->nullable()->comment(__('permissions.http paths'))->after('http_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('http_methods');
            $table->dropColumn('http_paths');
        });
    }
}
