<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'order_details', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'order_id' );
            $table->unsignedBigInteger( 'product_id' );
            $table->integer( 'quantity' )->default( 1 );
            $table->float( 'price' );
            $table->float( 'sub_total' );
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
        Schema::dropIfExists( 'order_details' );
    }
}
