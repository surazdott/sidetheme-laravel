<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_url')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('copyright')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('cover')->nullable();
            $table->string('logo_width')->nullable();
            $table->string('logo_height')->nullable();
            $table->string('main_color')->nullable();
            $table->string('body_color')->nullable();
            $table->string('header_color')->nullable();
            $table->string('footer_color')->nullable();
            $table->string('mail_driver')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_from')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->longtext('header_code')->nullable();
            $table->longtext('footer_code')->nullable();
            $table->unsignedInteger('max_upload_size')->nullable();
            $table->string('timezone')->nullable();
            $table->boolean('maintenance')->default(0);
            $table->boolean('ssl')->default(1);
            $table->boolean('app_debug')->default(1);
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
        Schema::dropIfExists('settings');
    }
}
