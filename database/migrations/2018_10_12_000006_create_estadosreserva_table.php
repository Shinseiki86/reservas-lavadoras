<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosreservaTable extends Migration
{
    private $nomTabla = 'ESTADOSRESERVA';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'ESTADOSRESERVA: mmm';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            
            $table->increments('ESRE_ID')
                ->comment('Valor autonumérico, llave primaria.');

            $table->string('ESRE_NOMBRE', 100)
                ->comment('descripción.');

            $table->string('ESRE_COLOR', 100)
                ->comment('descripción.');

            $table->string('ESRE_OBSERVACIONES', 300)
                ->comment('observaciones')->nullable();
            
            //Traza
            $table->string('ESRE_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('ESRE_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('ESRE_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('ESRE_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('ESRE_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('ESRE_FECHAELIMINADO')->nullable()
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
