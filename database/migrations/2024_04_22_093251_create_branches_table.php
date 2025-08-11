<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()
                ->comment('Tên chi nhánh');
            $table->string('slug')->nullable()
                ->comment('URL chi tiết chi nhánh');
            $table->string('address')->nullable()
                ->comment('Địa chỉ chi nhánh');
            $table->text('description')->nullable()
                ->comment('Mô tả sơ bộ chi nhánh');
            $table->tinyInteger('active')->default(1)
                ->comment('0: Không hoạt động; 1: Hoạt động');
            $table->tinyInteger('position')->default(0)
                ->comment('Sắp xếp thứ tự ưu tiên theo thứ tự càng nhỏ càn lên đầu');

            $table->bigInteger('province_id')->nullable()->unsigned();
            $table->bigInteger('district_id')->nullable()->unsigned();
            $table->bigInteger('ward_id')->nullable()->unsigned();

            $table->string('lat')->nullable()
                ->comment('LAT location google');
            $table->string('lng')->nullable()
                ->comment('LNG location google');
            $table->text('iframe')->nullable()
                ->comment('Iframe location google');

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
        Schema::dropIfExists('branches');
    }
}
