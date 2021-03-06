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
            $table->string('name');
            $table->string('company_name');
            $table->mediumText('description');
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('sni')->nullable()->default(0);
            $table->string('nomor_sni')->nullable();
            $table->integer('tkdn')->nullable()->default(0);
            $table->float('nilai_tkdn')->nullable();
            $table->string('nomor_sertifikat_tkdn')->nullable();
            $table->string('nomor_laporan_tkdn')->nullable();
            $table->integer('price')->nullable()->default(0);
            $table->string('hs_code')->nullable();
            $table->integer('provinsi_id')->nullable()->default(11);
            $table->integer('kabupaten_id')->nullable()->default(1101);
            $table->integer('kecamatan_id')->nullable()->default(1101010);
            $table->integer('is_active')->default(0);
            $table->string('image_path');
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
