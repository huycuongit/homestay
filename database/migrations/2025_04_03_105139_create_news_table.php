<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable()
                ->comment('Tên tin tức');
            $table->string('slug')->nullable()
                ->comment('URL chi tiết tin tức');

            $table->text('avatar')->nullable()
                ->comment('Ảnh tượng trưng cho 1 tin tức');
            $table->text('description')->nullable()
                ->comment('Mô tả sơ bộ tin tức');
            $table->longtext('content')->nullable()
                ->comment('Nội dung tin tức');

            $table->timestamp('publish_time')->nullable()
                ->comment('Thời gian phát hành');

            $table->tinyInteger('active')->default(1)
                ->comment('0: Không hoạt động; 1: Hoạt động');

            $table->tinyInteger('position')->default(0)
                ->comment('Sắp xếp thứ tự ưu tiên theo thứ tự càng nhỏ càn lên đầu');

            $table->tinyInteger('active_publish')->default(0);
            $table->integer('views')->default(0);

            $table->foreignId('created_by_id')
                ->nullable()
                ->comment('Người khơi tạo dữ liệu')
                ->constrained('admins', 'id')
                ->nullOnDelete();

            $table->foreignId('updated_by_id')
                ->nullable()
                ->comment('Người cập nhật cuối dữ liệu')
                ->constrained('admins', 'id')
                ->nullOnDelete();

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
        Schema::dropIfExists('news');
    }
}
