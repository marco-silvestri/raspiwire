<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMountSourceColumnFromGpiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gpios', function (Blueprint $table) {
            $table->dropColumn('mount_source');
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
            $table->string('mount_source')->after('name')->nullable();
        });
    }
}
