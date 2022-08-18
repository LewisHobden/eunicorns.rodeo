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
        Schema::create('event_groups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->char('group_name',255);
            $table->unsignedBigInteger('event_occurrence_id');

            $table->foreign('event_occurrence_id')->references('id')->on('event_occurrences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_groups');
    }
};
