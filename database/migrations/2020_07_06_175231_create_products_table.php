<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name')->nullable();
            $table->mediumText('description')->nullable();
            $table->integer('category_id')->default(99);
            $table->integer('subcategory_id')->default(99);
            $table->integer('sni')->default(0);
            $table->string('nomor_sni')->nullable();
            $table->integer('tkdn')->default(0);
            $table->float('nilai_tkdn')->nullable();
            $table->string('nomor_sertifikat_tkdn')->nullable();
            $table->string('nomor_laporan_tkdn')->nullable();
            $table->integer('price');
            $table->string('hs_code');
            $table->string('company_name')->nullable();
            $table->integer('provinsi_id');
            $table->integer('kabupaten_id');
            $table->integer('kecamatan_id');
            $table->string('image_path')->nullable();
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
        Schema::dropIfExists('products');
    }
}
