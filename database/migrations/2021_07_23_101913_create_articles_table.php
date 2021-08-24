<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->unsignedInteger('id', true);
            $table->unsignedInteger('owner_id')->nullable(false);
            $table->string('title', 191);
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->text('body');
            $table->boolean('is_published')->default(0);
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
