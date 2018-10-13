<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosLavadorasTable extends Migration
{
   private $nomTabla = 'USUARIOS_LAVADORAS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'Tabla de rompimiento (muchos-a-muchos) para asociar Usuarios con Lavadoras.';
        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;

        Schema::create($this->nomTabla, function (Blueprint $table) {

            $table->unsignedInteger('USER_ID')
                ->comment('Campo foráneo de la tabla USUARIOS.');

            $table->unsignedInteger('LAVA_ID')
                ->comment('Campo foráneo de la tabla LAVADORAS.');

            $table->primary(['LAVA_ID', 'USER_ID']);

            //Relaciones
            $table->foreign('USER_ID')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('LAVA_ID')
                ->references('LAVA_ID')
                ->on('LAVADORAS')
                ->onDelete('cascade');

        });
        
        //Comentario de la tabla
        try{
            if(env('DB_CONNECTION') == 'pgsql')
                DB::statement("COMMENT ON TABLE ".env('DB_SCHEMA').".\"".$this->nomTabla."\" IS '".$commentTabla."'");
            elseif(env('DB_CONNECTION') == 'mysql')
                DB::statement("ALTER TABLE ".$this->nomTabla." COMMENT = '".$commentTabla."'");
        } catch(\Exception $e){
            echo '      No fue posible colocar el comentario de la tabla.'. PHP_EOL; //$e->getMessage() 
        }
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
