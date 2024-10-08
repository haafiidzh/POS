<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->unsignedBigInteger('partner_id'); // Foreign key for partners
            $table->date('attendance_date'); // Date of attendance
            $table->time('check_in_time')->nullable(); // Check-in time
            $table->time('check_out_time')->nullable(); // Check-out time
            $table->string('location')->nullable(); // Location of attendance
            $table->enum('status', ['present', 'absent', 'late', 'excused'])->default('present'); // Attendance status
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint linking to the partners table
            $table->foreign('partner_id')
                ->references('id')
                ->on('partners')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};


// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('transaction', function (Blueprint $table) {
//             $table->foreignId('transaction_detail_id')->constrained()->onDelete('cascade');
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('transaction', function (Blueprint $table) {
            
//         });
//     }
// };
