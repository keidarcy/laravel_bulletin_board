<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class AddToMtbLikeDislikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::insert(
        "insert into mtb_like_dislikes (id, value, rank) values (:id, :value, :rank)",
        array('id' => 1,
              'value' => "無評価",
              'rank' => 1
              )
        );

        DB::insert(
          "insert into mtb_like_dislikes (id, value, rank) values (:id, :value, :rank)",
          array('id' => 2,
                'value' => "いいね",
                'rank' => 2
                )
        );

        DB::insert(
          "insert into mtb_like_dislikes (id, value, rank) values (:id, :value, :rank)",
          array('id' => 3,
                'value' => "やだね",
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
          DB::delete("delete from mtb_like_dislikes");
        ;
    }
}
