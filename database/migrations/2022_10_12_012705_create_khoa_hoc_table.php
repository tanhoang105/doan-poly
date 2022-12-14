<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khoa_hoc', function (Blueprint $table) {
            $table->id();
            $table->integer('id_danh_muc');
            $table->string('ten_khoa_hoc');
            $table->integer('gia_khoa_hoc');
            $table->string('mo_ta')->nullable();
            $table->string('tien_to')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->integer('luot_xem')->nullable();
            $table->integer('trang_thai')->default(1);
            $table->integer('delete_at')->default(1);
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
        Schema::dropIfExists('khoa_hoc');
    }
};
