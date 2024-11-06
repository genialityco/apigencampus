<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearRegitrosPemission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->integer('id')->index();
            $table->string('name', 255)->nullable();
            $table->string('guard_name', 255)->nullable();
            $table->string('role_ids', 255)->nullable();
        });
        DB::table("permissions")
        ->insert([
            [ "name" => "update_organization", "guard_name" => "web"],
            ["name" => "update_event", "guard_name" => "web"]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
}
