<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('order_id');
			$table->integer('batch_order');
			$table->text('dr_number');
			$table->integer('customer_id')->nullable();
			$table->text('destination')->nullable();
			$table->integer('customer_trucking_id')->nullable();
			$table->date('order_date')->nullable();
			$table->json('variety')->nullable();
			$table->json('kg')->nullable();
			$table->double('price', 8, 2)->nullable();
			$table->text('quantity')->nullable();
			$table->text('deductions')->nullable();
			$table->text('total')->nullable();
            $table->timestamps()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
