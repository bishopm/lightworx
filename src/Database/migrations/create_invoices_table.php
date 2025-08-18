<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoices', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->date('invoicedate');
            $table->integer('client_id');
            $table->decimal('total', 8,2);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
