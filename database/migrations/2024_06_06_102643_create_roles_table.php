<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable()
                ->comment('Tên Role');
            $table->string('name_key')->nullable()
                ->comment('Nhận dạng phân biệt');

            $table->tinyInteger('is_full_permission')->default(0)
                ->comment('0: Không Full quyền; 1: Full quyền');

            $table->tinyInteger('active')->default(1)
                ->comment('0: Không hoạt động; 1: Hoạt động');
            $table->tinyInteger('position')->default(0)
                ->comment('Sắp xếp thứ tự ưu tiên theo thứ tự càng nhỏ càn lên đầu');
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
        Schema::dropIfExists('roles');
    }
}
