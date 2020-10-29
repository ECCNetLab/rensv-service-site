<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFtpLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftp_logs', function (Blueprint $table) {
            $table->id();
            $table->string('msg');
            $table->string('user');
            $table->integer('pid');
            $table->string('host');
            $table->string('rhost');
            $table->timestamp('logtime');
            $table->timestamps();

            $table->foreign('user')->references('name')->on('ftp_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ftp_logs');
    }
}
