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
        Schema::create('vai_tro_nguoi_dung', function (Blueprint $table) {
            $table->id();
            $table->integer('id_vai_tro');
            $table->integer('id_user');
            $table->integer('trang_thai')->default(1);
            $table->integer('delete_at')->default(1);

//            $table->unsignedInteger('user_id');
//            $table->unsignedInteger('role_id');
//
//            $table->foreign('user_id')->references('id')->on('users')
//                ->onDelete('cascade');
//            $table->foreign('vai_tro_id')->references('id')->on('vai_tro')
//                ->onDelete('cascade');

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
        Schema::dropIfExists('vai_tro_nguoi_dung');
    }
};
