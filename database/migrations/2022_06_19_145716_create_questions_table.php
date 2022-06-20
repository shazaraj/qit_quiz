<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question')->default('0')->nullable();
            $table->string('opt1')->default('0')->nullable();
            $table->string('opt2')->default('0')->nullable();
            $table->string('opt3')->default('0')->nullable();
            $table->string('opt4')->default('0')->nullable();
            $table->string('answer')->default('0')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
