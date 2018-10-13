<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLavadorasTable extends Migration
{
    private $nomTabla = 'LAVADORAS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'LAVADORAS: mmm';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            
            $table->increments('LAVA_ID')
                ->comment('Valor autonumérico, llave primaria de la tabla atributos.');

            $table->string('LAVA_DESCRIPCION', 100)
                ->comment('descripción.');

            $table->integer('LAVA_CAPACIDAD')
                ->comment('capacidad litros.');

            $table->string('LAVA_OBSERVACIONES', 300)
                ->comment('observaciones')->nullable();
            
            //Traza
            $table->string('LAVA_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('LAVA_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('LAVA_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('LAVA_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('LAVA_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('LAVA_FECHAELIMINADO')->nullable()
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
