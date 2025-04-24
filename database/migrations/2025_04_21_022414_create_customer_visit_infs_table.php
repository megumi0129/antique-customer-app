<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_visit_infs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // 外部キー（customer_infs.id）
            $table->string('stylist_name', 60)->nullable();
            $table->tinyInteger('shimei')->nullable(); // 指名フラグ
            $table->string('menu', 160)->nullable();
            $table->string('price', 50)->nullable(); // 文字でもOKにするためstring
            $table->string('needed_time', 5)->nullable();
            $table->string('memo', 160)->nullable();
            $table->string('file_path1', 255)->nullable();
            $table->string('file_path2', 255)->nullable();
            $table->string('file_path3', 255)->nullable();
            $table->date('book_time')->nullable();
            $table->dateTime('update_time')->nullable();
            $table->softDeletes(); // 論理削除
            $table->timestamps();

            // 外部キー制約（削除連動）
            $table->foreign('customer_id')->references('id')->on('customer_infs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_visit_infs');
    }
};
