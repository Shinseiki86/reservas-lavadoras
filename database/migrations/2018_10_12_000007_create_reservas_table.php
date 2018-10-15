<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    private $nomTabla = 'RESERVAS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'RESERVAS: mmm';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            
            $table->increments('RESE_ID')
                ->comment('Valor autonumérico, llave primaria de la tabla atributos.');

            $table->datetime('RESE_FECHAINI')
                ->comment = "fecha inicio de la reserva";

            $table->unsignedTinyInteger('RESE_HORAS')->default(1)
                ->comment = "num horas de la reserva";

            $table->datetime('RESE_FECHAFIN')->nullable()
                ->comment = "fecha fin de la reserva";

            $table->mediumText('RESE_TITULO')->nullable()
                ->comment = "titulo de la reserva.";

            $table->integer('ESRE_ID')->unsigned()
                ->comment = 'Campo foráneo de la tabla ESTADOS_RESERVA.';

            $table->integer('LAVA_ID')->unsigned()
                ->comment = 'Campo foráneo de la tabla LAVADORAS.';


            //Traza
            $table->string('RESE_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('RESE_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('RESE_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('RESE_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('RESE_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('RESE_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');
                
            //Relaciones
            $table->foreign('ESRE_ID')
                ->references('ESRE_ID')
                ->on('ESTADOSRESERVA')
                ->onDelete('cascade');

            $table->foreign('LAVA_ID')
                ->references('LAVA_ID')
                ->on('LAVADORAS')
                ->onDelete('cascade');

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
