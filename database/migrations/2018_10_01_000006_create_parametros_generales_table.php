<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametrosGeneralesTable extends Migration
{
   private $nomTabla = 'PARAMETROSGENERALES';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'PARAMETROS GENERALES: contiene los parametros generales de la aplicación';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->increments('PAGE_ID')
                ->comment('Valor autonumérico, llave primaria de la tabla.');

            $table->string('PAGE_DESCRIPCION', 100)
                ->comment('descripcion del parametro');

            $table->string('PAGE_VALOR', 100)
                ->comment('valor del parametro');

            $table->string('PAGE_OBSERVACIONES', 300)
                ->comment('observaciones del parametro')->nullable();
            
            //Traza
            $table->string('PAGE_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('PAGE_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('PAGE_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('PAGE_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('PAGE_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('PAGE_FECHAELIMINADO')->nullable()
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
