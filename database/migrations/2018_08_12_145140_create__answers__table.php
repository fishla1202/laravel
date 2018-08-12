<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            //主鍵
            $table->increments('id');
            // 外來鍵設定
            $table->integer('question_id')->unsigned();
            $table->text('content');
            $table->timestamps();
            //  設定外來鍵 foreign 設定哪個欄位屬於外來鍵 references 設定外來鍵關聯表的哪個欄位 on 設定關聯表格
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //因為有外來鍵的關係 所以drop表格之前要先drop外來鍵的欄位
        Schema::table('ansers', function(Blueprint $table){
            $table->dropForeign('answers_question_id_foreign');
        });

        Schema::dropIfExists('answers');
    }
}
