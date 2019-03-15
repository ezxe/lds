<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title', 200);
            $table->text('subtitle',100);
            $table->datetime('date');
            $table->text('content');
            $table->boolean('outstanding')->default(false);
            $table->string('url_pdf');
            $table->string('url_video');
           
            //CLAVE FORANEA con respecto a Categoria
            $table->integer('category_id')->unsigned();           
            $table->foreign('category_id')->references('id')->on('categories');   

            $table->timestamps();
            $table->softDeletes();   

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
