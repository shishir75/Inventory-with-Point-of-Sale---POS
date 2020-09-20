<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'suppliers', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'name' );
            $table->string( 'email' )->unique();
            $table->string( 'address' );
            $table->string( 'photo' )->nullable();
            $table->string( 'phone' )->unique();
            $table->string( 'shop_name' )->nullable()->unique();
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
        Schema::dropIfExists( 'suppliers' );
    }
}
