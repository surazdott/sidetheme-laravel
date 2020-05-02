<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adsenses', function (Blueprint $table) {
            $table->id();
            $table->string('above_featured')->nullable();
            $table->string('above_latest')->nullable();
            $table->string('above_footer')->nullable();
            $table->string('above_image')->nullable();
            $table->string('above_desc')->nullable();
            $table->string('below_desc')->nullable();
            $table->string('above_details')->nullable();
            $table->string('above_downloads')->nullable();
            $table->string('above_tags')->nullable();
            $table->string('below_tags')->nullable();
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
        Schema::dropIfExists('adsenses');
    }
}
