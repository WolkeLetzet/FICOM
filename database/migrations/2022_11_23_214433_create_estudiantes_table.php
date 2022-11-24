<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('rut')->nullable()->default(null);
            $table->boolean('es_nuevo')->default(false);
            $table->string('prioridad')->default(1);
            $table->string('email_institucional')->unique()->nullable();
            $table->bigInteger('curso_id')->unsigned()->nullable();
            $table->bigInteger('apoderado_id')->unsigned()->nullable();
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('apoderado_id')->references('id')->on('apoderados')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
};
