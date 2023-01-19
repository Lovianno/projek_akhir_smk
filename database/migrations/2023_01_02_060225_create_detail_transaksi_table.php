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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transaksi_id');
            $table->foreign('transaksi_id')->references('id')->on('transaksi')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('tbl_barang')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('quantity');
            $table->integer('subtotal');
            
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
        Schema::dropIfExists('detail_transaksi');
    }
};
