<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscriptionColumnsToUserTable extends Migration
{
    protected $table;
    protected $column;

    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('iugu_id')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('iugu_id');
        });
    }
}