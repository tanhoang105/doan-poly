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
        Schema::create('phong_hoc', function (Blueprint $table) {
            $table->id();
            $table->string('ten_phong');
            $table->string('mo_ta')->nullable();
            $table->string('dia_chi');
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
        Schema::dropIfExists('phong_hoc');
    }
};
