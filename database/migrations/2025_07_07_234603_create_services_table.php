<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id()->comment('ID dịch vụ');
            $table->string('title')->comment('Tiêu đề dịch vụ');
            $table->string('slug')->comment('Đường đẫn');
            $table->text('description')->nullable()->comment('Mô tả chi tiết dịch vụ');
            $table->text('content')->nullable()->comment('Mô tả chi tiết dịch vụ');
            $table->string('avatar')->nullable()->comment('Tên hoặc đường dẫn icon đại diện');
            $table->boolean('active')->default(true)->comment('Trạng thái hoạt động (1: kích hoạt, 0: không)');
            $table->integer('position')->default(0)->comment('Thứ tự hiển thị');
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
        Schema::dropIfExists('services');
    }
}
