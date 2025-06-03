<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToGaleriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('galeri', function (Blueprint $table) {
        $table->timestamps(); // akan menambahkan created_at dan updated_at
    });
}

public function down()
{
    Schema::table('galeri', function (Blueprint $table) {
        $table->dropTimestamps();
    });
}

  
    
}
