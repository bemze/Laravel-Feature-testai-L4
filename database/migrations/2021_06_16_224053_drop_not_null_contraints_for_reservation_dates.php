<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropNotNullContraintsForReservationDates extends Migration
{ public function up()
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->date('start_from')->nullable()->change();
            $table->date('finish_till')->nullable()->change();
        });
    }
    public function down()
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->date('start_from')->nullable(false)->change();
            $table->date('finish_till')->nullable(false)->change();
        });
    }
}
