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
        Schema::create('product_variant', function (Blueprint $table) {
            $table->id(); // int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->foreignId('product_id')->constrained('product')->onDelete('cascade'); // int(11) NOT NULL (Khóa ngoại)
            $table->foreignId('colors_id')->constrained('colors')->onDelete('cascade'); // int(11) NOT NULL (Khóa ngoại)
            $table->string('stock', 50); // varchar(50) NOT NULL
            $table->timestamps(); // Không có trong SQL Dump, nhưng nên thêm
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};
