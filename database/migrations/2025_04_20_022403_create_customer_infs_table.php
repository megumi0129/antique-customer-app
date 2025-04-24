<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_infs', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT + PRIMARY KEY
            $table->string('salon_id', 20)->nullable(); // 美容室の独自ID
            $table->string('name', 60)->nullable();
            $table->string('tel', 160)->nullable();
            $table->string('tel2', 160)->nullable();
            $table->string('tel3', 160)->nullable();
            $table->string('email', 160)->nullable();
            $table->date('birth')->nullable();
            $table->string('memo', 20)->nullable();
            $table->string('detail_memo', 255)->nullable();
            $table->dateTime('update_time')->nullable();
            $table->date('lastdate')->nullable();
            $table->softDeletes(); // 論理削除
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_infs');
    }
};
