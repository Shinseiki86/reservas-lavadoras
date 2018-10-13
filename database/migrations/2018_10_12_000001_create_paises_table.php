<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaisesTable extends Migration
{
    
    private $nomTabla = 'PAISES';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'PAISES: contiene los países del territorio nacional';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {

            $table->increments('PAIS_ID')
                ->comment('Valor autonumérico, llave primaria de la tabla departamentos.');

            $table->unsignedInteger('PAIS_CODIGO')
                ->comment('Código del departamento de acuerdo a clasificación DANE');

            $table->string('PAIS_NOMBRE', 300)
                ->comment('Nombre del país');
            
            //Traza
            $table->string('PAIS_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('PAIS_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('PAIS_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('PAIS_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('PAIS_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('PAIS_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

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
