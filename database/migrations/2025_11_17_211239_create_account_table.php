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
        Schema::create('account', function (Blueprint $table) {
            $table->id(); // int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->string('username', 20)->unique(); // varchar(20) NOT NULL
            $table->string('password', 100); // varchar(100) NOT NULL
            $table->string('fullname', 250); // varchar(250) NOT NULL
            $table->date('birthday'); // date NOT NULL
            $table->string('phone', 20); // varchar(20) NOT NULL
            $table->string('address', 250); // varchar(250) NOT NULL
            $table->foreignId('role_id')->constrained('role'); // int(11) NOT NULL (Khóa ngoại)

            // Cột đã fix lỗi thứ tự
            $table->rememberToken()->nullable();

            // Không có created_at/updated_at trong SQL Dump, nhưng nên thêm cho Laravel
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
        Schema::dropIfExists('account');
    }
};
