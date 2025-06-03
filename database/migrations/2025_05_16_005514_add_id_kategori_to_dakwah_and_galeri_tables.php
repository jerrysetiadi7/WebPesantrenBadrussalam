<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdKategoriToDakwahAndGaleriTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('dakwah', function (Blueprint $table) {
        $table->unsignedBigInteger('id_kategori')->after('id')->nullable();
        $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('set null');
    });

    Schema::table('galeri', function (Blueprint $table) {
        $table->unsignedBigInteger('id_kategori')->after('id')->nullable();
        $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('dakwah', function (Blueprint $table) {
        $table->dropForeign(['id_kategori']);
        $table->dropColumn('id_kategori');
    });

    Schema::table('galeri', function (Blueprint $table) {
        $table->dropForeign(['id_kategori']);
        $table->dropColumn('id_kategori');
    });
}
}