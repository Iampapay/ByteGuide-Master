<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centre_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centre_id')->comment('id of users table [f_k]');
            $table->string('house_no');
            $table->string('street');
            $table->string('post_office');
            $table->string('police_station');
            $table->string('state');
            $table->string('dist');
            $table->string('block');
            $table->string('pin_code');
            $table->string('landline_no')->nullable();
            $table->string('fax_no')->nullable();
            $table->string('web_url')->nullable();
            $table->string('lat');
            $table->string('long');
            $table->string('spoc_name');
            $table->string('spoc_mob');
            $table->string('spoc_email');
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
        Schema::dropIfExists('centre_details');
    }
}
