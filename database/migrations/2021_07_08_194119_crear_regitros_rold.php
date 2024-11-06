<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearRegitrosRold extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prueba_roles', function (Blueprint $table) {
            $table->integer('id')->index();
            $table->string('name', 255)->nullable();
            $table->string('guard_name', 255)->nullable();
            
        });
        DB::table("prueba_roles")
        ->insertOrIgnore([
            [ "name" => "Administrador", "guard_name" => "web"],
            ["name" => "Colaborator", "guard_name" => "web"]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prueba_roles', function (Blueprint $table) {
            //
        });
    }
}
