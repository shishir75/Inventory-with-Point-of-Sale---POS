<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'salaries', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'employee_id' );
            $table->float( 'amount' );
            $table->date( 'date' );
            $table->string( 'month_year' );
            $table->timestamps();

            $table->foreign( 'employee_id' )->references( 'id' )->on( 'employees' )->onDelete( 'cascade' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'salaries' );
    }
}
