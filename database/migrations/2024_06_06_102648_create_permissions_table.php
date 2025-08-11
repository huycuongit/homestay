<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            
            $table->string('module')->nullable()
                ->comment('Module trong hệ thống');
            $table->string('module_name')->nullable()
                ->comment('Tên Module hiển thị trong hệ thống');

            $table->string('method')->nullable()
                ->comment('Phương thức của Module trong hệ thống');
            $table->string('method_name')->nullable()
                ->comment('Tên Phương thức của Module trong hệ thống');

            $table->string('route')->nullable()
                ->comment('Tịnh tuyến của phương thức trong hệ thống');

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
        Schema::dropIfExists('permissions');
    }
}
