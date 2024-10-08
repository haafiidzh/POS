<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title')->unique()->index();
            $table->string('slug_title')->unique()->index();
            $table->string('type')->default('product')->nullable();
            $table->string('thumbnail');
            $table->longText('description')->nullable();
            $table->text('tags')->nullable();
            $table->bigInteger('price')->default(0);
            $table->char('created_by', 8)->nullable();
            $table->char('published_by', 8)->nullable();
            $table->dateTime('published_at')->nullable();
            $table->dateTime('archived_at')->default(null)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
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
