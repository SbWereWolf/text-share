<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paste', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link');
            $table->unique(['link'],'ix_paste_link');
            $table->string('title')->default('');
            $table->text('content');
            $table->bigInteger('expiration',false,true);
            $table->integer('access',false,true);
            $table->index(['access','expiration'],'ix_paste_access_expiration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paste', function (Blueprint $table) {
            $table->dropIndex('ix_paste_link');
            $table->dropIndex('ix_paste_access_expiration');
        });

        Schema::dropIfExists('paste');
    }
}
