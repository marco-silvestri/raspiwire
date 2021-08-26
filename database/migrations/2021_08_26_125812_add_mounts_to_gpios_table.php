<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMountsToGpiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gpios', function (Blueprint $table) {
            $table->text('mount_source')->nullable();
            $table->text('mount_destination')->nullable();
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
            $table->dropColumn('mount_source');
            $table->dropColumn('mount_destination');
        });
    }
}
