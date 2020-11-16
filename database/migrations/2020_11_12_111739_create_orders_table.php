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
        Schema::create('carts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf16';
            $table->collation = 'utf16_general_ci';
            $table->increments('id');
            // foreign key of users table
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of restaurent_details table
            $table->integer('restaurent_id')->unsigned();
            $table->foreign('restaurent_id')->references('id')->on('restaurent_details')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of user_address table
            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('user_address')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('customer_name')->nullable();
            $table->string('applied_coupon')->nullable();
            $table->decimal('delivery_fee', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();
            $table->tinyInteger('visibility')->default('0');
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamps();
        });

        Schema::create('cart_submenus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf16';
            $table->collation = 'utf16_general_ci';
            $table->increments('id');
            // foreign key of users table
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of carts table
            $table->integer('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of menu_list table
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menu_list')->onDelete('cascade')->onUpdate('cascade');

            $table->string('quantity')->nullable();
            $table->tinyInteger('visibility')->default('0');
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf16';
            $table->collation = 'utf16_general_ci';
            $table->increments('id');
            // foreign key of users table
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of users table
            $table->integer('restaurent_id')->unsigned();
            $table->foreign('restaurent_id')->references('id')->on('restaurent_details')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of carts table
            $table->integer('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of user_address table
            $table->integer('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('user_address')->onDelete('cascade')->onUpdate('cascade');

            $table->string('order_id')->unique();
            $table->string('customer_name')->nullable();
            $table->json('ordered_menu')->nullable();
            $table->string('mobile')->nullable();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->decimal('delivery_fee', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->tinyInteger('visibility')->default('0');
            $table->timestamp('deleted_at', 0)->nullable();
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
        Schema::dropIfExists('cart_submenus');
        Schema::dropIfExists('carts');
    }
}
