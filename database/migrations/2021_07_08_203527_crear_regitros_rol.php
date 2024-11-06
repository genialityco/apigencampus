<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Account;

class CrearRegitrosRol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->integer('id')->index();
            $table->string('name', 255)->nullable();
            $table->string('guard_name', 255)->nullable();
            $table->string('permission_ids', 255)->nullable();
        });
        DB::table("roles")
        ->insert([
            [ "name" => "Administrador", "guard_name" => "web"],
            ["name" => "Contributor", "guard_name" => "web"]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            //
        });
    }
}
