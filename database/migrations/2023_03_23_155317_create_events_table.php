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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type'); // 1: Tich theo tien; 2: tich theo so luong order
            $table->string('name');
            $table->text('des');
            $table->date('start');
            $table->date('end');
            $table->double('unit',9,2); // Gia tri quy doi tuong ung voi 1 diem
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
        Schema::dropIfExists('events');
    }
};
