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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->tinyInteger('price_type'); // 1 : Giam theo phan tram; 2 : Giam theo luong tien 
            $table->text('des');
            $table->double('price',9,2); // Neu phan tram thi theo % 
            $table->date('start'); // Ngay bat dau
            $table->date('end'); // Ngay ket thuc
            $table->double('condition',9,2); //Dieu kien gia ap dung cho san pham
            $table->unsignedInteger('point');
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
        Schema::dropIfExists('coupons');
    }
};
