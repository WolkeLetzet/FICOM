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
            $table->string('rut')->unique()->nullable()->default(null);
            $table->string('dv')->nullable()->default(null);
            $table->boolean('es_nuevo')->default(false);
            
            $table->enum('prioridad', array('Sin Beneficios', 'Prioritario', 'Nuevo Prioritario'))->default('Sin Beneficios');
            $table->string('email_institucional')->nullable();
            $table->string('telefono')->default('')->nullable();
            $table->string('direccion')->default('')->nullable();

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
