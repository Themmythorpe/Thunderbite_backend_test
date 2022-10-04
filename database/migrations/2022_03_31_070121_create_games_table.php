<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained();
            $table->foreignId('prize_id')->nullable()->constrained(); //id of the won prize
            $table->integer('points')->nullable();
            $table->integer('prizeamount')->nullable();
            $table->string('popup_image')->nullable();
            $table->string('message')->nullable();
            $table->string('account'); //username of the user who played the game
            $table->dateTime('revealed_at')->nullable(); //timestamp in campaign's timezone
            // when the game has been played - it can be different than created_at
            $table->timestamps();

            $table->index('id', 'default_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
