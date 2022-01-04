<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('CASCADE')->onDelete('CASCADE');
            $table->string('shipping_price')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('total_price')->nullable();
            $table->enum('order_progress', ['IN_PACKAGING', 'ON_DELIVERY', 'RECEIVED'])->nullable();
            $table->enum('payment_status', ['CREATED', 'PENDING', 'PAID'])->nullable();
            $table->string('payment_token')->nullable();
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
}
