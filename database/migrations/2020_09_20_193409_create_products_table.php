<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'products', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'category_id' );
            $table->unsignedBigInteger( 'supplier_id' );
            $table->string( 'name' );
            $table->string( 'code' )->nullable()->unique();
            $table->string( 'photo' )->nullable();
            $table->float( 'buying_price' )->nullable();
            $table->float( 'selling_price' );
            $table->integer( 'quantity' );
            $table->string( 'root' )->nullable();
            $table->date( 'buying_date' )->nullable();
            $table->timestamps();

            $table->foreign( 'category_id' )->references( 'id' )->on( 'categories' )->onDelete( 'cascade' );
            $table->foreign( 'supplier_id' )->references( 'id' )->on( 'suppliers' )->onDelete( 'cascade' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'products' );
    }
}
