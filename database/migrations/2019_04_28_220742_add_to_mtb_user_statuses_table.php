<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddToMtbUserStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::insert(
        "insert into mtb_user_statuses (id, value, rank) values (:id, :value, :rank)",
        array('id' => 1,
              'value' => "未認証",
              'rank' => 1
              )
        );


        DB::insert(
          "insert into mtb_user_statuses (id, value, rank) values (:id, :value, :rank)",
          array('id' => 2,
                'value' => "認証済",
                'rank' => 2
                )
        );

        DB::insert(
          "insert into mtb_user_statuses (id, value, rank) values (:id, :value, :rank)",
          array('id' => 3,
                'value' => "退会済",
                'rank' => 3
                )
        );
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          DB::delete("delete from mtb_user_statuses");
        ;
    }
}
