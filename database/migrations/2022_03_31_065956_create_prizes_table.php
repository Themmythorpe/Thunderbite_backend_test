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
        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained();
            $table->string('name');
            $table->string('description')->nullable();
            // $table->string('level'); //low, med, high
            $table->enum('level', ['low','med', 'high']);
            $table->string('redirect_desktop')->nullable();
            $table->string('redirect_mobile')->nullable();
            $table->decimal('weight', 10, 2)->nullable(); // 0.01 - 99.99, determines the chance of winning
            $table->timestamp('starts_at')->nullable(); //prize can be won from this date onwards
            $table->timestamp('ends_at')->nullable(); //until this date
            $table->timestamps();

            $table->index(['name', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prizes');
    }
};
