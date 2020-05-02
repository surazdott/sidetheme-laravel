<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('download_link')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->string('compatible')->nullable();
            $table->string('author')->nullable();
            $table->string('released')->nullable();
            $table->string('version')->nullable();
            $table->string('framework')->nullable();
            $table->string('file_size')->nullable();
            $table->string('files_included')->nullable();
            $table->string('documentation')->nullable();
            $table->string('compatible_browser')->nullable();
            $table->string('live_demo')->nullable();
            $table->unsignedInteger('download')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
}
