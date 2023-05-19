<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemePublishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_publishes', function (Blueprint $table) {

            $table->id();
            $table->string('theme_id');
            $table->timestamps();
//            $table->id();
//            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
//            $table->string('shop_url')->nullable()->default('NULL');
//            $table->string('theme_id')->default('NULL');
//            $table->string('previous_theme_id')->default('NULL');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme_publishes');
    }
}
