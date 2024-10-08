<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('banner_type');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('desktop_media_path');
            $table->string('mobile_media_path');
            $table->string('placement_route');
            $table->string('alt')->nullable();
            $table->text('references_url')->nullable();
            $table->unsignedBigInteger('position');
            $table->boolean('is_active')->default(1);
            $table->string('desktop_background_position')->default('center center')->nullable();
            $table->string('mobile_background_position')->default('center center')->nullable();
            $table->boolean('with_caption')->default(0)->nullable();
            $table->string('caption_title')->nullable();
            $table->text('caption_text')->nullable();
            $table->boolean('with_button')->default(0)->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
