<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('user_id', 8)->nullable(); 
            $table->string('maps_link')->nullable();
            $table->string('identify_number');
            $table->string('address');
            $table->string('phone');
            $table->enum('status', ['active', 'pending', 'hold'])->default('pending');
            
            // Sesuaikan tipe data dengan kolom id di tabel referensi
            $table->char('provinces_id', 2);
            $table->char('regencies_id', 4);
            $table->char('districts_id', 7);
            $table->char('villages_id', 10);
            
            $table->timestamps();
        
            // Definisikan foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('provinces_id')->references('id')->on('id_provinces')->onDelete('cascade');
            $table->foreign('regencies_id')->references('id')->on('id_regencies')->onDelete('cascade');
            $table->foreign('districts_id')->references('id')->on('id_districts')->onDelete('cascade');
            $table->foreign('villages_id')->references('id')->on('id_villages')->onDelete('cascade');
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
