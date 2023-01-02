<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionAndPreviousStockColumnsOnMovementsTable extends Migration
{
    public function up()
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->integer('previous_stock')->default(0);
        });
    }

    public function down()
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->dropColumn('description');
            // $table->dropColumn('description');
        });
    }
}
