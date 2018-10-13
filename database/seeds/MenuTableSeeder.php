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

        $orderItem = 0;
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
            ]);

        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Contratos',
            'MENU_ICON' => 'fas fa-file-contract',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);
            Menu::create([
                'MENU_LABEL' => 'Clasificación de ocupaciones',
                'MENU_URL' => 'cnfg-contratos/cnos',
                'MENU_ICON' => 'fas fa-list-ol',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('cno-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Cargos',
                'MENU_URL' => 'cnfg-contratos/cargos',
                'MENU_ICON' => 'fas fa-sign-language',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('cargo-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Tipos de contratos',
                'MENU_URL' => 'cnfg-contratos/tiposcontratos',
                'MENU_ICON' => 'fas fa-handshake',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('tipocontrato-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Empresas temporales',
                'MENU_URL' => 'cnfg-contratos/temporales',
                'MENU_ICON' => 'fas fa-briefcase',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('temporal-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Clases de contratos',
                'MENU_URL' => 'cnfg-contratos/clasescontratos',
                'MENU_ICON' => 'fas fa-id-card',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('clasecontrato-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Estados de contratos',
                'MENU_URL' => 'cnfg-contratos/estadoscontratos',
                'MENU_ICON' => 'fas fa-cube',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('estadocontrato-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Motivos de retiro',
                'MENU_URL' => 'cnfg-contratos/motivosretiros',
                'MENU_ICON' => 'fas fa-hand-point-right',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('motivoretiro-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Bancos',
                'MENU_URL' => 'cnfg-contratos/bancos',
                'MENU_ICON' => 'fas fa-piggy-bank',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('banco-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Negocios',
                'MENU_URL' => 'cnfg-contratos/negocios',
                'MENU_ICON' => 'fas fa-user-tie',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('negocio-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Atributos',
                'MENU_URL' => 'cnfg-contratos/atributos',
                'MENU_ICON' => 'fas fa-asterisk',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('atributo-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Atributos Empl.',
                'MENU_URL' => 'cnfg-contratos/empleadoatributo',
                'MENU_ICON' => 'fas fa-id-badge',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('empleadoatributo-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Tipos de Documentos',
                'MENU_URL' => 'cnfg-contratos/tiposdocumentos',
                'MENU_ICON' => 'fas fa-indent',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('tipodocumento-index'),
            ]);

        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Organizacionales',
            'MENU_ICON' => 'fas fa-sitemap',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);
            Menu::create([
                'MENU_LABEL' => 'Empleadores',
                'MENU_URL' => 'cnfg-organizacionales/empleadores',
                'MENU_ICON' => 'fas fa-user-tie',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('empleador-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Gerencias',
                'MENU_URL' => 'cnfg-organizacionales/gerencias',
                'MENU_ICON' => 'fas fa-arrows-alt',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('gerencia-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Procesos',
                'MENU_URL' => 'cnfg-organizacionales/procesos',
                'MENU_ICON' => 'fas fa-crosshairs',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('proceso-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Centros de costos',
                'MENU_URL' => 'cnfg-organizacionales/centroscostos',
                'MENU_ICON' => 'fas fa-dollar-sign',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('centrocosto-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Tipos de empleadores',
                'MENU_URL' => 'cnfg-organizacionales/tiposempleadores',
                'MENU_ICON' => 'fas fa-bars',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('tipoempleador-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Riesgos ARL',
                'MENU_URL' => 'cnfg-organizacionales/riesgos',
                'MENU_ICON' => 'fas fa-fire',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('riesgo-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Grupos de Empleados',
                'MENU_URL' => 'cnfg-organizacionales/grupos',
                'MENU_ICON' => 'fas fa-people-carry',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('grupo-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Turnos',
                'MENU_URL' => 'cnfg-organizacionales/turnos',
                'MENU_ICON' => 'fas fa-clock',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('turno-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Plantas Laborales',
                'MENU_URL' => 'cnfg-organizacionales/plantaslaborales',
                'MENU_ICON' => 'fas fa-chart-area',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('plantalaboral-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Movimientos de Plantas',
                'MENU_URL' => 'cnfg-organizacionales/movimientosplantas',
                'MENU_ICON' => 'fas fa-sort-amount-down',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('movimientoplanta-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Tipo Entidades',
                'MENU_URL' => 'cnfg-organizacionales/tipoentidades',
                'MENU_ICON' => 'fas fa-university',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('tipoentidad-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Entidades',
                'MENU_URL' => 'cnfg-organizacionales/entidades',
                'MENU_ICON' => 'fas fa-monument',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('entidad-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Periodos',
                'MENU_URL' => 'cnfg-organizacionales/periodos',
                'MENU_ICON' => 'fas fa-calendar-check',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('periodo-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Periodos de Nómina',
                'MENU_URL' => 'cnfg-organizacionales/periodosnominas',
                'MENU_ICON' => 'fas fa-calendar-plus',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('periodonomina-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Conceptos de Nómina',
                'MENU_URL' => 'cnfg-organizacionales/conceptos',
                'MENU_ICON' => 'fas fa-outdent',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('concepto-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Novedades de Nómina',
                'MENU_URL' => 'cnfg-organizacionales/novedades',
                'MENU_ICON' => 'fas fa-clipboard',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('novedad-index'),
            ]);
            

        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Tickets Disciplinarios',
            'MENU_ICON' => 'fas fa-ticket-alt',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);
            Menu::create([
                'MENU_LABEL' => 'Prioridades',
                'MENU_URL' => 'cnfg-tickets/prioridades',
                'MENU_ICON' => 'fas fa-sort-numeric-down',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('prioridad-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Estados de Ticket',
                'MENU_URL' => 'cnfg-tickets/estadostickets',
                'MENU_ICON' => 'fas fa-cube',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('estadoticket-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Sanciones',
                'MENU_URL' => 'cnfg-tickets/sanciones',
                'MENU_ICON' => 'fas fa-cube',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('sancion-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Estados de Aprobaciones',
                'MENU_URL' => 'cnfg-tickets/estadosaprobaciones',
                'MENU_ICON' => 'fas fa-check-circle',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('estadoaprobacion-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Categorías',
                'MENU_URL' => 'cnfg-tickets/categorias',
                'MENU_ICON' => 'fas fa-newspaper',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('categoria-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Tipos de Incidentes',
                'MENU_URL' => 'cnfg-tickets/tiposincidentes',
                'MENU_ICON' => 'fas fa-exclamation-triangle',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('tipoincidente-index'),
            ]);


        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Ausentismos',
            'MENU_ICON' => 'fas fa-user-times',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);
            Menu::create([
                'MENU_LABEL' => 'Diagnósticos',
                'MENU_URL' => 'cnfg-ausentismos/diagnosticos',
                'MENU_ICON' => 'fas fa-heartbeat',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('diagnostico-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Tipo Ausentismos',
                'MENU_URL' => 'cnfg-ausentismos/tipoausentismos',
                'MENU_ICON' => 'fas fa-wrench',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('tipoausentismo-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Concepto Ausencias',
                'MENU_URL' => 'cnfg-ausentismos/conceptoausencias',
                'MENU_ICON' => 'fas fa-bookmark',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('conceptoausencia-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Ausentismos',
                'MENU_URL' => 'cnfg-ausentismos/ausentismos',
                'MENU_ICON' => 'fas fa-bed',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('ausentismo-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Prorroga Ausentismo',
                'MENU_URL' => 'cnfg-ausentismos/prorrogaausentismos',
                'MENU_ICON' => 'fas fa-arrow-circle-right',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('prorrogaausentismo-index'),
            ]);

        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Casos Médicos',
            'MENU_ICON' => 'fas fa-stethoscope',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);
            Menu::create([
                'MENU_LABEL' => 'DX Generales',
                'MENU_URL' => 'cnfg-casosmedicos/diagnosticosgenerales',
                'MENU_ICON' => 'fas fa-hospital',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('diagnosticogeneral-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Estados de Restricción',
                'MENU_URL' => 'cnfg-casosmedicos/estadosrestriccion',
                'MENU_ICON' => 'fas fa-heart',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('estadorestriccion-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Casos Médicos',
                'MENU_URL' => 'cnfg-casosmedicos/casosmedicos',
                'MENU_ICON' => 'fas fa-user-md',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('casomedico-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Novedades Médicas',
                'MENU_URL' => 'cnfg-casosmedicos/novedadesmedicas',
                'MENU_ICON' => 'fas fa-medkit',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('novedadmedica-index'),
            ]);
        /*
        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Selección',
            'MENU_ICON' => 'fas fa-male',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);
            Menu::create([
                'MENU_LABEL' => 'Requisiciones de Personal',
                'MENU_URL' => 'cnfg-seleccion/requisiciones',
                'MENU_ICON' => 'fas fa-file-text-o',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('requisiciones-index'),
            ]);

            Menu::create([
                'MENU_LABEL' => 'Asociación de Candidatos',
                'MENU_URL' => 'cnfg-seleccion/requisicionesprospectos',
                'MENU_ICON' => 'fas fa-chevron-circle-right',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('requisicionesprospectos-index'),
            ]);

            Menu::create([
                'MENU_LABEL' => 'Motivos de Requisiciones',
                'MENU_URL' => 'cnfg-seleccion/motivosrequisiciones',
                'MENU_ICON' => 'fas fa-navicon',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('motivosrequisiciones-index'),
            ]);

            Menu::create([
                'MENU_LABEL' => 'Estados de Requisiciones',
                'MENU_URL' => 'cnfg-seleccion/estadosrequisiciones',
                'MENU_ICON' => 'fas fa-newspaper-o',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('estadosrequisiciones-index'),
            ]);

            Menu::create([
                'MENU_LABEL' => 'Responsables de Requisiciones',
                'MENU_URL' => 'cnfg-seleccion/encargadosrequisiciones',
                'MENU_ICON' => 'fas fa-user-o',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('encargadosrequisiciones-index'),
            ]);

            Menu::create([
                'MENU_LABEL' => 'Estados de Candidatos',
                'MENU_URL' => 'cnfg-seleccion/estadosprospectos',
                'MENU_ICON' => 'fas fa-check',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('estadosprospectos-index'),
            ]);
        */

        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Reportes',
            'MENU_ICON' => 'fas fa-filter',
            'MENU_URL' => 'reportes',
            'MENU_ORDER' => $orderMenuLeft++,
            'PERM_ID' => $this->getPermission('reportes'),
        ]);

        //TOP
        Menu::create([
            'MENU_LABEL' => 'Tickets',
            'MENU_URL' => 'cnfg-tickets/tickets',
            'MENU_ICON' => 'fas fa-id-badge',
            'MENU_ORDER' => $orderMenuTop++,
            'MENU_POSITION' => 'TOP',
            'PERM_ID' => $this->getPermission('ticket-index'),
        ]);

        $parent = Menu::create([
            'MENU_LABEL' => 'Certificados',
            'MENU_ICON' => 'fas fa-certificate',
            'MENU_URL' => 'gestion-humana/contratos/certificados',
            'MENU_ORDER' => $orderMenuTop++,
            'MENU_POSITION' => 'TOP',
            'PERM_ID' => $this->getPermission('certificadocontrato'),
        ]);

        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Gestión Humana',
            'MENU_ICON' => 'fas fa-users',
            'MENU_ORDER' => $orderMenuTop++,
            'MENU_POSITION' => 'TOP',
        ]);
            Menu::create([
                'MENU_LABEL' => 'Contratos',
                'MENU_URL' => 'gestion-humana/contratos',
                'MENU_ICON' => 'fas fa-handshake',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderMenuTop++,
                'MENU_POSITION' => 'TOP',
                'PERM_ID' => $this->getPermission('contrato-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Hojas de Vida',
                'MENU_URL' => 'gestion-humana/prospectos',
                'MENU_ICON' => 'fas fa-id-card',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderMenuTop++,
                'MENU_POSITION' => 'TOP',
                'PERM_ID' => $this->getPermission('prospecto-index'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Novedades de Nómina',
                'MENU_URL' => 'cnfg-organizacionales/novedades',
                'MENU_ICON' => 'fas fa-clipboard',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderMenuTop++,
                'MENU_POSITION' => 'TOP',
                'PERM_ID' => $this->getPermission('novedad-index'),
            ]);
            /*
            Menu::create([
                'MENU_LABEL' => 'Validador de TNL',
                'MENU_URL' => 'gestion-humana/helpers/validadorTNL',
                'MENU_ICON' => 'fas fa-check-square-o',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'MENU_POSITION' => 'TOP',
                'PERM_ID' => $this->getPermission('tnl'),
            ]);
            */

        $parent = Menu::create([
            'MENU_LABEL' => 'Gestión de Turnos',
            'MENU_ICON' => 'fas fa-hourglass',
            'MENU_ORDER' => $orderMenuTop++,
            'MENU_POSITION' => 'TOP',
        ]);

         Menu::create([
                'MENU_LABEL' => 'Programación de Turnos',
                'MENU_URL' => 'gestion-humana/movimientosempleados',
                'MENU_ICON' => 'fas fa-male',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderMenuTop++,
                'MENU_POSITION' => 'TOP',
                'PERM_ID' => $this->getPermission('movimientoempleado-index'),
            ]);

         Menu::create([
                'MENU_LABEL' => 'Toma de Asistencias',
                'MENU_URL' => 'gestion-humana/asistenciasempleados',
                'MENU_ICON' => 'fas fa-list',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderMenuTop++,
                'MENU_POSITION' => 'TOP',
                'PERM_ID' => $this->getPermission('asistenciasempleados'),
            ]);

         Menu::create([
                'MENU_LABEL' => 'Clasificación de Personal',
                'MENU_URL' => 'gestion-humana/listarContratos',
                'MENU_ICON' => 'fas fa-map',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderMenuTop++,
                'MENU_POSITION' => 'TOP',
                'PERM_ID' => $this->getPermission('listarContratos'),
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
