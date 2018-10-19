<?php

use Illuminate\Database\Seeder;
use LAVA\Models\Menu;
use LAVA\Models\Permission;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderMenuLeft = 0;
        $orderMenuTop = 0;


        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Admin',
            'MENU_ICON' => 'fas fa-cogs',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);
            Menu::create([
                'MENU_LABEL' => 'Menú',
                'MENU_URL' => 'app/menu',
                'MENU_ICON' => 'fas fa-bars',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'MENU_ENABLED' => true,
                'PERM_ID' => $this->getPermission('app-menu'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Parametrizaciones generales',
                'MENU_URL' => 'app/parameters',
                'MENU_ICON' => 'fas fa-cog',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('app-parameters'),
           ]);
            Menu::create([
                'MENU_LABEL' => 'Carga másiva',
                'MENU_URL' => 'app/upload',
                'MENU_ICON' => 'fas fa-cog',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('app-upload'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Parametros del Sistema',
                'MENU_URL' => 'app/parametrosgenerales',
                'MENU_ICON' => 'fas fa-bolt',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('app-parametrosgenerales'),
            ]);

        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Usuarios y roles',
            'MENU_ICON' => 'fas fa-user-circle',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);
            Menu::create([
                'MENU_LABEL' => 'Usuarios',
                'MENU_URL' => 'auth/usuarios',
                'MENU_ICON' => 'fas fa-user',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('user-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Roles',
                'MENU_URL' => 'auth/roles',
                'MENU_ICON' => 'fas fa-male',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('role-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Permisos',
                'MENU_URL' => 'auth/permisos',
                'MENU_ICON' => 'fas fa-address-card',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('permission-index'),
            ]);

        /*$orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Geográficos',
            'MENU_ICON' => 'fas fa-globe-americas',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);
            Menu::create([
                'MENU_LABEL' => 'Países',
                'MENU_URL' => 'cnfg-geograficos/paises',
                'MENU_ICON' => 'fas fa-map-marker-alt',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('pais-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Departamentos',
                'MENU_URL' => 'cnfg-geograficos/departamentos',
                'MENU_ICON' => 'fas fa-map-marker-alt',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('departamento-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Ciudades',
                'MENU_URL' => 'cnfg-geograficos/ciudades',
                'MENU_ICON' => 'fas fa-map-marker-alt',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('ciudad-index'),
            ]);*/


        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Reportes',
            'MENU_ICON' => 'fas fa-filter',
            'MENU_URL' => 'reportes',
            'MENU_ORDER' => $orderMenuLeft++,
            'PERM_ID' => $this->getPermission('reportes'),
        ]);




        //**********************  TOP *****************************
        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Lavadoras',
            'MENU_URL' => 'core/lavadoras',
            'MENU_ICON' => 'fas fa-fill-drip',
            'MENU_ORDER' => $orderMenuTop++,
            'MENU_POSITION' => 'TOP',
            'PERM_ID' => $this->getPermission('lavadora-index'),
        ]);
        /*    Menu::create([
                'MENU_LABEL' => 'Crear',
                'MENU_URL' => 'core/lavadoras/create',
                'MENU_ICON' => 'fas fa-handshake',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderMenuTop++,
                'MENU_POSITION' => 'TOP',
                'PERM_ID' => $this->getPermission('lavadora-create'),
            ]);*/


        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Reservas',
            'MENU_ICON' => 'fas fa-ticket-alt',
            'MENU_URL' => 'core/reservas',
            'MENU_ORDER' => $orderMenuTop++,
            'MENU_POSITION' => 'TOP',
            'PERM_ID' => $this->getPermission('reserva-index'),
        ]);

   
    }

    //??
    private function getPermission($namePermission)
    {
        $perm = Permission::where('name', $namePermission)->get()->first();
        if(isset($perm))
            return $perm->id;
        return null;
    }
}
