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
        Schema::create('event_group_members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('event_group_id');
            $table->unsignedBigInteger('character_id');

            $table->foreign('event_group_id')->references('id')->on('event_groups');
            $table->foreign('character_id')->references('id')->on('characters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_group_members');
    }
};
