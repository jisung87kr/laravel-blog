<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('comment_order');
            $table->unsignedBigInteger('depth');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
