<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RedirectRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirect_request', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('requestId');
            $table->string('locale', 5);
            $table->string('documentType', 2);
            $table->string('document', 12);
            $table->string('name', 60);
            $table->string('surname', 60);
            $table->string('company', 60);
            $table->string('email', 80);
            $table->string('street', 80);
            $table->string('city', 80);
            $table->string('state', 80);
            $table->string('postalCode', 10);
            $table->string('country', 2);
            $table->string('phone', 80);
            $table->string('mobile', 30);
            $table->string('reference', 30);
            $table->string('description', 80);
            $table->string('currency', 3);
            $table->decimal('total', 18, 2);
            $table->string('expiration', 25);
            $table->string('ipAddress', 15);
            $table->string('userAgent', 150);
            $table->string('processUrl', 300);
            $table->string('status', 18);
            $table->string('reason', 3);
            $table->string('message', 200);
            $table->string('date', 25);
            $table->string('payment_status', 18)->nullable();
            $table->string('payment_reason', 3)->nullable();
            $table->string('payment_message', 200)->nullable();
            $table->string('payment_date', 200)->nullable();
            $table->string('payment_reference', 30)->nullable();
            $table->string('payment_authorization', 20)->nullable();
            $table->string('payment_currency', 3)->nullable();
            $table->decimal('payment_total', 18, 2)->nullable();
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
        Schema::dropIfExists('redirect_request');
    }
}
