<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms', function (Blueprint $table) {
            $table->string('hash')->after('id')->nullable();
            $table->string('last_response_status')->after('first_response_status')->nullable();
            $table->dateTime('delivered_at')->after('text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms', function (Blueprint $table) {
            $table->dropColumn('hash');
            $table->dropColumn('last_response_status');
            $table->dropColumn('delivered_at');
        });
    }
}
