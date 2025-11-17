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
        Schema::create('product', function (Blueprint $table) {
            $table->id(); // int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->foreignId('cate_id')->constrained('cate'); // int(11) NOT NULL (Khóa ngoại)
            $table->string('name', 250); // varchar(250) NOT NULL
            $table->integer('price'); // int(250) NOT NULL (dùng integer vì SQL là int, nhưng nên dùng decimal)
            $table->string('size', 20)->nullable(); // varchar(20) DEFAULT NULL
            $table->text('description'); // text NOT NULL
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
        Schema::dropIfExists('products');
    }
};
