<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

class AddRatingFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->prefix.'products', function (Blueprint $table) {
            $table->float('rating')->after('status')->index();
            $table->float('real_rating')->after('status')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->prefix.'products', function (Blueprint $table) {
            $table->dropColumn('rating');
            $table->dropColumn('real_rating');
        });
    }
}
