<?php
	
use Illuminate\Database\Seeder;
use LAVA\Models\User;
use LAVA\Models\Role;
use LAVA\Models\Permission;

	class UsersTableSeeder extends Seeder {

        private $rolOwner;
        private $rolAdmin;
        private $rolUser;


		public function run() {

            $pass = '123';
            $date = \Carbon\Carbon::now()->toDateTimeString();
            //$faker = Faker\Factory::create('es_ES');

            //*********************************************************************
           $this->command->info('--- Seeder Creación de Roles');

                $this->rolOwner = Role::create([
                    'name'         => 'owner',
                    'display_name' => 'Project Owner',
                    'description'  => 'User is the owner of a given project',
                ]);
                $this->rolAdmin = Role::create([
                    'name'         => 'admin',
                    'display_name' => 'Administrador',
                    'description'  => 'User is allowed to manage and edit other users',
                ]);
                $this->rolUser = Role::create([
                    'name'         => 'user',
                    'display_name' => 'Cliente',
                    'description'  => 'Un usuario común',
                ]);



            //*********************************************************************
            $this->command->info('--- Seeder Creación de Permisos');

                $menu = Permission::create([
                    'name'         => 'app-menu',
                    'display_name' => 'Administrar menú',
                    'description'  => 'Permite crear, eliminar y ordenar el menú del sistema.',
                ]);
                $parameters = Permission::create([
                    'name'         => 'app-parameters',
                    'display_name' => 'Administrar parámetros',
                    'description'  => 'Permite crear, eliminar y ordenar los parámetros del sistema.',
                ]);
                $uploads = Permission::create([
                    'name'         => 'app-upload',
                    'display_name' => 'Cargas masivas',
                    'description'  => '¡CUIDADO! Permite realizar cargas masivas de datos en el sistema.',
                ]);
                $parametersg = Permission::create([
                    'name'         => 'app-parametrosgenerales',
                    'display_name' => 'Administrar parámetros generales del Sistema',
                    'description'  => 'Permite crear, eliminar y ordenar los parámetros generales del sistema.',
                ]);

                $this->rolOwner->attachPermissions([$menu, $parameters, $uploads]);
                $this->rolAdmin->attachPermission($menu, $parametersg);

                $reportes = Permission::create([
                    'name'         => 'reportes',
                    'display_name' => 'Reportes',
                    'description'  => 'Permite ejecutar reportes y exportarlos.',
                ]);
                $this->rolOwner->attachPermission($reportes);
                $this->rolAdmin->attachPermissions([$reportes,$uploads]);

                $this->createPermissions(User::class, 'usuarios', null,  true, false);
                $this->createPermissions(Permission::class, 'permisos', null, true, false);
                $this->createPermissions(Role::class, 'roles', null, true, false);

                $this->createPermissions(Pais::class, 'países', null, true, false);
                $this->createPermissions(Departamento::class, 'departamentos', null, true, false);
                $this->createPermissions(Ciudad::class, 'ciudades', null, true, false);

                $perms = $this->createPermissions(Lavadora::class, 'lavadoras', null, true, false);
                $this->rolUser->attachPermissions([
                    $perms['index'],
                    $perms['create'],
                    $perms['edit'],
                ]);
                
                /*$listasistencia = Permission::create([
                    'name'         => 'asistenciasempleados',
                    'display_name' => 'listado de asistencia',
                    'description'  => 'Permite tomar lista de asistencia del personal',
                ]);
                $this->rolAdmin->attachPermission($listasistencia);
                $rolSuperOper->attachPermission($listasistencia);
                $rolCoorOper->attachPermission($listasistencia);
                $this->rolGestHum->attachPermission($listasistencia);*/



            //*********************************************************************
            $this->command->info('--- Seeder Creación de Usuarios prueba');

                //Admin
                $admin = User::firstOrcreate( [
                    'name' => 'Administrador',
                    'cedula' => 1,
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password'  => \Hash::make($pass),
                ]);
                $admin->attachRole($this->rolAdmin); 
                $admin->lavadoras()->sync([1,3]); 

                //Owner
                $owner = User::create( [
                    'name' => 'Owner',
                    'cedula' => 2,
                    'username' => 'owner',
                    'email' => 'owner@mail.com',
                    'password'  => \Hash::make($pass),
                ]);
                $owner->attachRole($this->rolOwner);
                $admin->lavadoras()->sync([1,3]); 

                //Editores
                $user1 = User::create( [
                    'name' => 'Usuario 1',
                    'cedula' => 444444444,
                    'username' => 'usuario',
                    'email' => 'usuario@misena.edu.co',
                    'password'  => \Hash::make($pass),
                    'USER_CREADOPOR'  => 'PRUEBAS'
                ]);
                $user1->attachRole($this->rolUser);
                $user1->lavadoras()->sync([1,3]); 

                //5 usuarios faker
                //$users = factory(LAVA\User::class)->times(5)->create();

		}

        private function createPermissions($name, $display_name, $description = null, $attachAdmin=true, $attachGestHum=true)
        {
            //$name = strtolower(basename($name));
            $name = str_replace('sgh\\models\\','',strtolower(basename($name)));

            if($description == null)
                $description = $display_name;

            $create = Permission::create([
                'name'         => $name.'-create',
                'display_name' => 'Crear '.$display_name,
                'description'  => 'Crear '.$description,
            ]);
            $edit = Permission::create([
                'name'         => $name.'-edit',
                'display_name' => 'Editar '.$display_name,
                'description'  => 'Editar '.$description,
            ]);
            $index = Permission::create([
                'name'         => $name.'-index',
                'display_name' => 'Listar '.$display_name,
                'description'  => 'Listar '.$description,
            ]);
            $delete = Permission::create([
                'name'         => $name.'-delete',
                'display_name' => 'Borrar '.$display_name,
                'description'  => 'Borrar '.$description,
            ]);

            if($attachAdmin)
                $this->rolAdmin->attachPermissions([$index, $create, $edit, $delete]);


            return compact('create', 'edit', 'index', 'delete');
        }

	}