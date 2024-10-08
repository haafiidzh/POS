<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('id_districts', function (Blueprint $table) {
            $table->char('id', 7)->primary();
            $table->char('regency_id', 4);
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('id_districts', function (Blueprint $table) {
            $table->foreign('regency_id')->references('id')->on('id_regencies')->cascadeOnDelete();
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
        Schema::dropIfExists('id_districts');
    }
}