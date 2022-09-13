<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotografiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotografias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fotografo_id');
			$table->string('imagen');
			$table->date('fecha');
			$table->string('descripcion')->nullable();
			$table->integer('categoria_id');
			$table->string('tecnica')->nullable();
			$table->string('camara')->nullable();
			$table->string('objetivo')->nullable();
			$table->string('iso')->nullable();
			$table->string('balance')->nullable();
			$table->string('velocidad')->nullable();
			$table->string('diafragma')->nullable();
            $table->unsignedBigInteger('creadopor_id')->nullable();
            $table->unsignedBigInteger('actualizadopor_id')->nullable();
			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotografias');
    }
}
