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
        Schema::create('nerds', function (Blueprint $table) {
            $table->id()->startingValue(1_000_001);
            $table->string('type')->index();
            $table->string('code')->index();
            $table->string('name')->nullable();
            $table->string('nick')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('photo')->nullable();
            $table->json('oauth')->nullable();
            $table->json('meta')->nullable();
            $table->json('info')->nullable();
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
        Schema::dropIfExists('nerds');
    }
};
