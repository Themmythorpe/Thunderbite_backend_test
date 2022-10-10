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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('timezone'); //all dates are compared to this timezone
            $table->string('name');
            $table->string('slug');
            $table->string('targeting')->nullable();
            $table->string('segmentation')->nullable();
            $table->integer('games_allowed')->nullable();
            $table->integer('games_frequency')->nullable();
            $table->integer('three_matches')->nullable();
            $table->integer('four_matches')->nullable();
            $table->integer('five_matches')->nullable();
            $table->timestamp('starts_at')->nullable(); //campaign can be used (games played on it) from this date onwards
            $table->timestamp('ends_at')->nullable(); //campaign can be used until this date
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
        Schema::dropIfExists('campaigns');
    }
};
