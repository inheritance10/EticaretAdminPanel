<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('kategori_id');
            $table->string('urun_adi');
            $table->unsignedDouble('urun_fiyat');
            $table->unsignedInteger('urun_stok');
            $table->unsignedInteger('urun_satis_miktari');
            $table->unsignedInteger('kalan_adet');
            $table->string('file_name');
            $table->unsignedInteger('urun_kar');
            $table->unsignedInteger('urun_zarar');
            $table->unsignedDouble('urun_zam');
            $table->unsignedDouble('urun_indirim');
            $table->softDeletes();
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
};
