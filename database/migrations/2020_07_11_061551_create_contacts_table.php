<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_phone');
            $table->string('company_email');
            $table->string('company_address');
            $table->string('company_country');
            $table->string('company_whatsapp');
            $table->string('company_telegram');
            $table->string('company_facebook');
            $table->string('company_instagram');
            $table->string('company_twitter');
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
        Schema::dropIfExists('contacts');
    }
}
