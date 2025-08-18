<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clients', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('client');
            $table->string('contact_firstname');
            $table->string('contact_surname');
            $table->string('contact_email');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
