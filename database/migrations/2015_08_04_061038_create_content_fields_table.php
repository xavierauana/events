<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Schema;

    class CreateContentFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display');
            $table->string('code');
            $table->string('type');
            $table->boolean('required');
            $table->string('pattern');
            $table->string('placeholder');
            $table->integer('template_id')->unsigned();
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
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
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('content_fields');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
