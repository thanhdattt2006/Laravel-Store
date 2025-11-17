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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('account');
            $table->foreignId('payments_id')->constrained('payments');
            $table->foreignId('voucher_discount_id')->nullable()->constrained('voucher_discount');
            $table->integer('grand_price');
            $table->dateTime('created_day')->nullable();
            $table->dateTime('updated_day')->nullable();
            $table->string('fullname', 250);
            $table->integer('phone');
            $table->string('address', 250);
            $table->string('note', 250)->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('orders');
    }
};
