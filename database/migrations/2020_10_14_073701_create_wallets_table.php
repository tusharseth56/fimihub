<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qbeez_wallets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf16';
            $table->collation = 'utf16_general_ci';
            $table->increments('id');
            // foreign key of users table
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            //rest attributes
            $table->decimal('open_balance', 15, 3)->default('0');
            $table->string('wallet_type');
            $table->tinyInteger('user_type')->comment('1-Admin,2-Merchant,3-User');
            $table->tinyInteger('visibility')->default('0');
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamps();
        });

        Schema::create('payment_gateway_transactions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf16';
            $table->collation = 'utf16_general_ci';
            $table->increments('id');
            // foreign key of users table
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            //rest attributes
            $table->string('txn_id')->unique()->nullable();
            $table->string('token');
            $table->string('txn_type')->comment('1-Credited,2-Debited');
            $table->decimal('amount', 15, 3)->default(0);
            $table->string('status')->comment('success,failure,pending');
            $table->string('comment')->nullable();
            $table->json('bank_response')->nullable();
            $table->tinyInteger('visibility')->default('0');
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamps();
        });

        Schema::create('vouchers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf16';
            $table->collation = 'utf16_general_ci';
            $table->increments('id');
            // foreign key of users table
            $table->integer('source_id')->unsigned()->nullable();
            $table->foreign('source_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('coupon_code')->unique();
            $table->decimal('amount', 15, 3)->default(0);
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('visibility')->default('0');
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamps();
        });

        Schema::create('qbeez_wallet_transactions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf16';
            $table->collation = 'utf16_general_ci';
            $table->increments('id');
            // foreign key of qbeez_wallets table
            $table->integer('qbeez_wallet_id')->unsigned();
            $table->foreign('qbeez_wallet_id')->references('id')->on('qbeez_wallets')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of payment_gateway_transactions table
            $table->integer('gateway_id')->unsigned()->nullable();;
            $table->foreign('gateway_id')->references('id')->on('payment_gateway_transactions')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of payment_gateway_transactions table
            $table->integer('voucher_id')->unsigned()->nullable();;
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of user sender_id table
            $table->integer('sender_id')->unsigned()->nullable();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // foreign key of user reciever_id table
            $table->integer('reciever_id')->unsigned();
            $table->foreign('reciever_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            //rest attributes
            $table->string('txn_id')->unique();
            $table->string('txn_type')->comment('1-Credited,2-Debited');
            $table->decimal('amount', 15, 3)->default(0);
            $table->string('status')->comment('1-success,2-failure,3-pending');
            $table->string('txn_mode')->comment('1-wallet,2-gateway,3-voucher')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('qbeez_wallet_transactions');
        Schema::dropIfExists('payment_gateway_transactions');
        Schema::dropIfExists('vouchers');
        Schema::dropIfExists('qbeez_wallets');
    }
}
