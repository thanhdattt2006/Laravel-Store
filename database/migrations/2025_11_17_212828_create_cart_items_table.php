<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id(); // int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY

            // Khóa ngoại: product_id (Trỏ đến bảng 'product')
            $table->foreignId('product_id')->constrained('product'); // int(11) NOT NULL

            // Khóa ngoại: cart_id (Trỏ đến bảng 'cart')
            $table->foreignId('cart_id')->constrained('cart'); // int(11) NOT NULL

            $table->integer('quantity'); // int(50) NOT NULL
            $table->integer('total'); // int(100) NOT NULL
            $table->integer('size'); // int(100) NOT NULL

            // Khóa ngoại: color_id (Trỏ đến bảng 'colors', có thể NULL)
            $table->foreignId('color_id')->nullable()->constrained('colors'); // int(11) DEFAULT NULL

            $table->timestamps(); // Nên thêm cho Laravel
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
