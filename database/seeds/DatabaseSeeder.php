<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaisesTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(CiudadesTableSeeder::class);

        $this->call(LavadorasTableSeeder::class);


        
        $this->call(UsersTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(ParametrosGeneralesTableSeeder::class);
    }
}
