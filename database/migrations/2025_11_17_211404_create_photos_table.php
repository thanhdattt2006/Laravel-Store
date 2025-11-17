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
        Schema::create('photo', function (Blueprint $table) {
            $table->id(); // int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->string('name', 250); // varchar(250) NOT NULL
            // Khóa ngoại: product_variant_id (Có thể NULL)
            $table->foreignId('product_variant_id')->nullable()->constrained('product_variant')->onDelete('cascade');
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
        Schema::dropIfExists('photos');
    }
};
