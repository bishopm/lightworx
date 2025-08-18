<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoicedisbursements', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('invoice_id');
            $table->string('details');
            $table->decimal('disbursement', 5,2)->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('invoicedisbursements');
    }
};
