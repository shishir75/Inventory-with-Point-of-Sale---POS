<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'employees', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'name' );
            $table->string( 'email' )->unique();
            $table->bigInteger( 'phone' )->unique();
            $table->bigInteger( 'nid' )->unique()->nullable();
            $table->date( 'joining_date' );
            $table->text( 'address' );
            $table->string( 'photo' )->nullable();
            $table->integer( 'salary' );
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
        Schema::dropIfExists( 'employees' );
    }
}
