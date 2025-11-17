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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id(); // int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->string('photo', 250); // varchar(250) NOT NULL
            $table->string('title', 250); // varchar(250) NOT NULL
            $table->string('description', 250); // varchar(250) NOT NULL
            $table->text('content'); // text NOT NULL
            $table->date('created_at')->nullable(); // date DEFAULT NULL
            $table->date('updated_at')->nullable(); // date DEFAULT NULL
            // Khóa ngoại trỏ đến account
            $table->foreignId('account_id')->constrained('account'); // int(11) NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_us');
    }
};
