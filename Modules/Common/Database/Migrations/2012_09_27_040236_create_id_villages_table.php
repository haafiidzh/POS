<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('id_villages', function (Blueprint $table) {
            $table->char('id', 10)->primary();
            $table->char('district_id', 7);
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('id_villages', function (Blueprint $table) {
            $table->foreign('district_id')->references('id')->on('id_districts')->cascadeOnDelete();
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('id_villages');
    }
}