<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentosTable extends Migration
{
    
    private $nomTabla = 'DEPARTAMENTOS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'DEPARTAMENTOS: contiene los departamentos del territorio nacional';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->increments('DEPA_ID')
                ->comment('Valor autonumérico, llave primaria de la tabla departamentos.');

            $table->unsignedInteger('DEPA_CODIGO')
                ->comment('Código del departamento de acuerdo a clasificación DANE');

            $table->unsignedInteger('PAIS_ID')
                ->comment('Llave foranea con PAISES');

            $table->string('DEPA_NOMBRE', 300)
                ->comment('Nombre del departamento');

            //Traza
            $table->string('DEPA_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('DEPA_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('DEPA_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('DEPA_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('DEPA_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('DEPA_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relación con tabla DEPARTAMENTOS
            $table->foreign('PAIS_ID')
                ->references('PAIS_ID')
                ->on('PAISES')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        
        if(env('DB_CONNECTION') == 'pgsql')
            DB::statement("COMMENT ON TABLE ".env('DB_SCHEMA').".\"".$this->nomTabla."\" IS '".$commentTabla."'");
        elseif(env('DB_CONNECTION') == 'mysql')
            DB::statement("ALTER TABLE ".$this->nomTabla." COMMENT = '".$commentTabla."'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo '- Borrando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::dropIfExists($this->nomTabla);
    }

}
