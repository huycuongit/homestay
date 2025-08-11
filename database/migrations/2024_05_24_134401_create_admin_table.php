<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('user_name', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->integer('type')->comment('1 - all access');
            $table->integer('status')->default(1);
            $table->boolean('no_remove')->default(false);

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
        Schema::dropIfExists('admins');
    }
}
