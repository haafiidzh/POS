<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retributions', function (Blueprint $table) {
            $table->id();
            $table->decimal('nominal', 15, 2);
            $table->integer('number_of_days');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->enum('is_active', [0 , 1])->default('1');
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
        Schema::dropIfExists('products');
    }
}
