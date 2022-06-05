<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHdUuidColumnToGpiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gpios', function (Blueprint $table) {
            $table->string('hd_uuid')->after('mount_source')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gpios', function (Blueprint $table) {
            $table->dropColumn('hd_uuid');
            $table->dropColumn('mount_source');
        });
    }
}
