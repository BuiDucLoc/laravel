<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //lenh thêm 1 trương mới user_cattalog_id vào bảng usser
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_catalogue_id')->defautl(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //lenh xoa đi bản usercataloiue khi roolback về lạc
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_catalogue_id');
        });
    }
};
