<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string("name",255);
            $table->string("address",100)->nullable();
            $table->string("contact",12)->nullable();
            $table->enum("gender",["M","F"])->default("M");
            $table->string("qualification")->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();

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
        Schema::dropIfExists('students');
    }
};
