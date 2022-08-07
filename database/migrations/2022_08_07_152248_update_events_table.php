<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn("date_time");
            $table->date("scheduled_date");
            $table->text("event_title");
            $table->text("event_type");
            $table->boolean("is_signup_open");
            $table->unsignedSmallInteger("item_level");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dateTime("date_time");

            $table->dropColumn("event_title");
            $table->dropColumn("event_type");
            $table->dropColumn("is_signup_open");
            $table->dropColumn("item_level");
            $table->dropColumn("scheduled_date");
        });
    }
};
