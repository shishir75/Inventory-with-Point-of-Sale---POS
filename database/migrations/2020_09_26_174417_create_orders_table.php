<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'orders', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'customer_id' );
            $table->integer( 'quantity' );
            $table->float( 'sub_total' );
            $table->float( 'vat' );
            $table->float( 'total' );
            $table->float( 'paid' );
            $table->float( 'due' )->default( 0 );
            $table->string( 'paidBy' );
            $table->date( 'date' );
            $table->string( 'month' );
            $table->integer( 'year' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'orders' );
    }
}
