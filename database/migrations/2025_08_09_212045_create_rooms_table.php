<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->string('name');
            $table->integer('max_guests')->default(1);
            $table->decimal('price_per_night', 10, 2);
            $table->decimal('price_per_hour', 10, 2);
            $table->string('type')->nullable();
            
            $table->boolean('active')->default(true)->comment('Trạng thái hoạt động (1: kích hoạt, 0: không)');
            $table->integer('position')->default(0)->comment('Thứ tự hiển thị');
        
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
