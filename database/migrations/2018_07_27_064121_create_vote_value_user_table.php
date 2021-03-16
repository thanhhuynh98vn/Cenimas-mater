<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteValueUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_value_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vote_value_id');
            $table->integer('user_id');
            //2 cai nay phai unique  thoi tu lam tiep nhe toi di an oke bac de em nghin cuu xem sao
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_value_user');
    }
}
