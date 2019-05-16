<?php

use App\Activitat;
use App\Alumne;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



if (!function_exists("logged_user")){
    function logged_user(){
        return json_encode(optional(Auth::user())->map());
    }
}

if (!function_exists("map_collection")){
    function  map_collection($collection){
        return $collection -> map(function ($item){
            return $item->map();
        });
    }
}

if (! function_exists("map_simple_collection")) {
    function map_simple_collection($collection)
    {
        return $collection->map(function($item) {
            return $item->mapSimple();
        });
    }
}

if (!function_exists("create_role")) {
    function create_role($role)
    {
        try {
            return Role::create([
                "name" => $role
            ]);
        } catch(Exception $e) {
            return Role::findByName($role);
        }
    }
}

if (!function_exists("create_permission")) {
    function create_permission($permission)
    {
        try {
            return Permission::create([
                "name" => $permission
            ]);
        } catch(Exception $e) {
            return Permission::findByName($permission);
        }
    }
}

if (!function_exists("initialize_roles")) {
    function initialize_roles() {
        $roles = [
            "AlumnesManager",
            "Alumnes",
            "ActivitatsManager",
            "Activitats",
            "EntitatsManager",
            "Entitats"
        ];
        foreach ($roles as $role) {
            create_role($role);
        }
        $alumneManagerPermissions = [
            "alumnes.index",
            "alumnes.show",
            "alumnes.store",
            "alumnes.update",
            "alumnes.destroy"
        ];
        $activitatsManagerPermissions = [
            "activitats.index",
            "activitats.show",
            "activitats.store",
            "activitats.update",
            "activitats.destroy"
        ];
        $entitatsManagerPermissions =  [
          "entitats.index",
          "entitats.show" ,
          "entitats.store"  ,
          "entitats.update"  ,
          "entitats.destroy"
        ];

        $alumnePermissions = [
            "user.alumnes.index",
            "user.alumnes.show",
            "user.alumnes.store",
            "user.alumnes.update",
            "user.alumnes.destroy"
        ];
        $activitatsPermissions = [
            "user.activitats.index",
            "user.activitats.show",
            "user.activitats.store",
            "user.activitats.update",
            "user.activitats.destroy"
        ];
        $entitatsPermissions = [
          "user.entitats.index",
          "user.entitats.index" ,
          "user.entitats.index" ,
          "user.entitats.index"  ,
          "user.entitats.index"  ,
        ];


        $permissions = array_merge(
            $alumneManagerPermissions,
            $alumnePermissions,
            $activitatsManagerPermissions,
            $activitatsPermissions,
            $entitatsManagerPermissions,
            $entitatsPermissions

        );

        foreach ($permissions as $permission) {
            create_permission($permission);
        }
        $rolePermissions = [
            "AlumnesManager" => $alumneManagerPermissions,
            "Alumnes" => $alumnePermissions,
            "ActivitatsManager" => $activitatsManagerPermissions,
            "Activitats" => $activitatsPermissions,
            "EntitatsManager" => $entitatsManagerPermissions,
            "Entitats" => $entitatsPermissions
        ];
        foreach ($rolePermissions as $role => $rolePermission) {
            $role = Role::findByName($role);
            foreach ($rolePermission as $permission) {
                $role->givePermissionTo($permission);
            }
        }
    }
}


if (!function_exists("initialize_gates")){
    function initialize_gates(){
        Gate::define("alumnes.manage",function ($user){
            return $user->isSuperAdmin() || $user->hasRole("AlumnesManager");
        });
        Gate::define("activitats.manage",function ($user){
            return $user->isSuperAdmin() || $user->hasRole("ActivitatsManager");
        })  ;
        Gate::define("entitats.manage",function ($user){
            return $user->isSuperAdmin() || $user->hasRole("EnitatsManager");
        })  ;
    }
}


if (!function_exists("create_primary_user")){
    function create_primary_user() {
        $user = User::where("email","mirokshirojas@univers.cat")->first();
        if (!$user) {

            $user =User::firstOrCreate ([
                "name" => "Mirokshi Rojas",
                "email" => "mirokshirojas@univers.cat",
                "password" => bcrypt(env("PRIMARY_USER_PASSWORD", "secret"))
            ]);

                $user->admin = true;
                $user->save();
        }
    }
}

if (!function_exists("create_example_alumnes")) {

    function create_example_alumnes()
    {
        $user = factory(User::class)->create();
       Alumne::create([
            "name" => "Jose",
            "surname" => "Lopez",
            "birthdate" =>'22/10/2000',
           "age" => 12,
            "school" => "IES EBRE",
            "school_course" => "CFGS",
            "sex" => "Altre",
            "phone" => "777888999",
            "user_id" => $user->id
        ]);
        Alumne::create([
            "name" => "Marc",
            "surname" => "Mestre",
            "birthdate" =>'22/10/2000',
            "age" => 12,
            "school" => "IES EBRE",
            "school_course" => "CFGS",
            "sex" => "Home",
            "phone" => "616531219",
            "user_id" => $user->id
        ]);
        Alumne::create([
            "name" => "Martha",
            "surname" => "Ramirez",
            "birthdate" => '22/10/2000',
            "age" => 12,
            "school" => "IES EBRE",
            "school_course" => "CFGS",
            "sex" => "Dona",
            "phone" => "656445152",
            "user_id" => $user->id
        ]);

        $user2 = factory(User::class)->create();
        Alumne::create([
            "name" => "Juan",
            "surname" => "Gutierrez Sanchez",
            "birthdate" =>'22/10/2000',
            "age" => 12,
            "school" => "IES EBRE",
            "course" =>date("Y")."-".(date("Y")+1),
            "school_course" => "CFGS",
            "sex" => "Home",
            "phone" => "616531219",
            "user_id" => $user2->id
        ]);
        Alumne::create([
            "name" => "Carla",
            "surname" => "Garcia Gomez",
            "birthdate" => '22/10/2000',
            "age" => 12,
            "school" => "IES EBRE",
            "course" =>date("Y")."-".(date("Y")+1),
            "school_course" => "CFGS",
            "sex" => "Dona",
            "phone" => "987654321",
            "user_id" => $user2->id
        ]);
        Alumne::create([
            "name" => "Joan",
            "surname" => "Roque",
            "birthdate" => '22/10/2000',
            "age" => 12,
            "school" => "IES EBRE",
            "course" =>date("Y")."-".(date("Y")+1),
            "school_course" => "CFGS",
            "sex" => "Home",
            "phone" => "123456789",
            "user_id" => $user2->id
        ]);
        Alumne::create([
            "name" => "Juan",
            "surname" => "Lopez",
            "birthdate" =>'22/10/2000',
            "age" => 12,
            "school" => "IES EBRE",
            "course" =>"2017-2018",
            "school_course" => "CFGS",
            "sex" => "Home",
            "phone" => "123456789",
            "user_id" => $user2->id
        ]);

    }
}

if (!function_exists("create_example_simple_activitat")) {

    function create_example_simple_activitat()
    {
        $user = User::find(1);
        Activitat::create([
            "name" => "Futbol",
            "date_start" => "22/10/2000",
            "date_final" => "22/10/2000",
            "course" => date("Y")."-".(date("Y")+1),
            "user_id" => $user->id
        ]);
        Activitat::create([
            "name" => "Comedor",
            "date_start" => "22/10/2000",
            "date_final" => "22/10/2000",
            "course" => date("Y")."-".(date("Y")+1),
            "user_id" => $user->id
        ]);
        Activitat::create([
            "name" => "Repaso",
            "date_start" => "22/10/2000",
            "date_final" => "22/10/2000",
            "course" =>date("Y")."-".(date("Y")+1),
            "user_id" => $user->id
        ]);
        Activitat::create([
            "name" => "Natacion",
            "date_start" => "22/10/2000",
            "date_final" => "22/10/2000",
            "course" =>date("Y")."-".(date("Y")+1),
            "user_id" => $user->id
        ]);
        Activitat::create([
            "name" => "Excursion",
            "date_start" => "22/10/2000",
            "date_final" => "22/10/2000",
            "course" => date("Y")."-".(date("Y")+1),
            "user_id" => $user->id
        ]);
        Activitat::create([
            "name" => "Excursion",
            "date_start" => "22/10/2000",
            "date_final" => "22/10/2000",
            "course" => date("Y")."-".(date("Y")+1),
            "user_id" => $user->id
        ]);
    }
}
if (!function_exists("create_example_alumnes_with_actvitats")){
    function create_example_alumnes_with_actvitats(){

        $user = User::find(1);

        $alumne = Alumne::create([
           "name"=> "Paco",
           "surname" => "Diaz",
            "birthdate" =>'22/10/2000',
            "age" => 12,
            "school" => "IES EBRE",
            "course" =>"2017-2018",
            "school_course" => "CFGS",
            "sex" => "Home",
            "phone" => "123456789",
           "user_id" => $user->id
        ]);

        $activitat1 = Activitat::create([
           "name" => "A1"
        ]);
        $activitat2 = Activitat::create([
           "name"=> "A2"
        ]);
        $activitat3 = Activitat::create([
            "name"=> "A3"
        ]);

        $alumne->addActivitat($activitat1);
        $alumne->addActivitat($activitat2);
        $alumne->addActivitat($activitat3);

    }
}

if (!function_exists("migrate_entitats")){
    function migrate_entitats(){
        $fortega = factory(User::class)->create([
            "name" => "Francesc Ortega",
            "email" => "fortega@univers.cat",
        ]);

        $fortega->admin = true;
        $fortega->save();

        $lorena = factory(User::class)->create([
            "name" => "Lorena Pujol",
            "email" => "lpujol@univers.cat",
        ]);
        $lorena->admin = true;
        $lorena->save();

        $ajuntament =factory(User::class)->create([
            "name" => "Ajuntament de Tortosa",
            "email" => "ajuntament_tortosa@univers.cat"
        ]);
        $ajuntament->assignRole('Alumnes');
        $ajuntament->assignRole('Activitats');

        $generalitat =factory(User::class)->create([
            "name" => "Generalitat de Catalunya",
            "email" => "generalitat@univers.cat"
        ]);
        $generalitat->assignRole('Alumnes');
        $generalitat->assignRole('Activitats');

        $asici =factory(User::class)->create([
            "name" => "ACISI",
            "email" => "acisi@univers.cat"
        ]);
        $asici->assignRole('Alumnes');
        $asici->assignRole('Activitats');

        $blanquerna = factory(User::class)->create([
            "name" => "Grup Esplai Blanquerna",
            "email" => "blanquerna@univers.cat"
        ]);
        $blanquerna->assignRole('Alumnes');
        $blanquerna->assignRole('Activitats');

        $atzavara =factory(User::class)->create([
            "name" => "Atzavara-arrels",
            "email" => "atzavara@univers.cat"
        ]);
        $atzavara->assignRole('Alumnes');
        $atzavara->assignRole('Activitats');


        $caritas = factory(User::class)->create([
            "name" => "Càritas Interparroquial Tortosa",
            "email" => "caritas@univers.cat"
        ]);
        $caritas->assignRole('Alumnes');
        $caritas->assignRole('Activitats');

        $crueRoja  = factory(User::class)->create([
            "name" => "Creu Roja Tortosa",
            "email" => "creu_roja@univers.cat"
        ]);
        $crueRoja->assignRole('Alumnes');
        $crueRoja->assignRole('Activitats');

        $patronat = factory(User::class)->create([
            "name" => "Espai Patronat de Tortosa",
            "email" => "patronat@univers.cat"
        ]);
        $patronat->assignRole('Alumnes');
        $patronat->assignRole('Activitats');

        $gentis = factory(User::class)->create([
            "name" => "Fundació Gentis",
            "email" => "gentis@univers.cat"
        ]);
        $gentis->assignRole('Alumnes');
        $gentis->assignRole('Activitats');

        $entitatssocials = factory(User::class)->create([
            "name" => "Federació d’Entitats Socials de les Terres de l’Ebre",
            "email" => "enitats_socials@univers.cat"
        ]);
        $entitatssocials->assignRole('Alumnes');
        $entitatssocials->assignRole('Activitats');

        $amics =factory(User::class)->create([
            "name" => "Associació d’Amigues i Amics de la UNESCO de Tortosa",
            "email" => "amics@univers.cat"
        ]);
        $amics->assignRole('Alumnes');
        $amics->assignRole('Activitats');

        $bancAliments =factory(User::class)->create([
            "name" => "Banc d’aliments",
            "email" => "banc_aliments@univers.cat"
        ]);
        $bancAliments->assignRole('Alumnes');
        $bancAliments->assignRole('Activitats');

        $artxicofradia =factory(User::class)->create([
            "name" => "Artxicofradia Mare de Déu de la Cinta",
            "email" => "artxicofradia@univers.cat"
        ]);
        $artxicofradia->assignRole('Alumnes');
        $artxicofradia->assignRole('Activitats');

        $proteccionCivil =factory(User::class)->create([
            "name" => "Protecció civil",
            "email" => "proteccio_civil@univers.cat"
        ]);
        $proteccionCivil->assignRole('Alumnes');
        $proteccionCivil->assignRole('Activitats');

        $fath = factory(User::class)->create([
            "name" => "Comunitat al Fath",
            "email" => "comunitat_fath@univers.cat"
        ]);
        $fath->assignRole('Alumnes');
        $fath->assignRole('Activitats');

        $concepcio =factory(User::class)->create([
            "name" => "Fundació Puríssima Concepció",
            "email" => "fundacion_purisima@univers.cat"
        ]);
        $concepcio->assignRole('Alumnes');
        $concepcio->assignRole('Activitats');

        $iesebre =factory(User::class)->create([
            "name" => "IES de l’Ebre",
            "email" => "iesebre@univers.cat"
        ]);
        $iesebre->assignRole('Alumnes');
        $iesebre->assignRole('Activitats');

        $urv =factory(User::class)->create([
            "name" => "Universitat Rovira i Virgili",
            "email" => "urv@univers.cat"
        ]);
        $urv->assignRole('Alumnes');
        $urv->assignRole('Activitats');

        $uoc = factory(User::class)->create([
            "name" => "Universitat Oberta de Catalunya",
            "email" => "uoc@univers.cat"
        ]);
        $uoc->assignRole('Alumnes');
        $uoc->assignRole('Activitats');

        $oficinaJove =factory(User::class)->create([
            "name" => "Oficina Jove del Baix Ebre",
            "email" => "oficina_Jove@univers.cat"
        ]);
        $oficinaJove->assignRole('Alumnes');
        $oficinaJove->assignRole('Activitats');

        $fcb = factory(User::class)->create([
            "name" => "Fundació Futbol Club Barcelona",
            "email" => "fcb@univers.cat"
        ]);
        $fcb->assignRole('Alumnes');
        $fcb->assignRole('Activitats');

        $gambusi =factory(User::class)->create([
            "name" => "Gambusí",
            "email" => "gambusí@univers.cat"
        ]);
        $gambusi->assignRole('Alumnes');
        $gambusi->assignRole('Activitats');

        $fbr = factory(User::class)->create([
            "name" => "Club Fútbol Bítem-Remolins",
            "email" => "futbol_bitem-remolins@univers.cat"
        ]);
        $fbr->assignRole('Alumnes');
        $fbr->assignRole('Activitats');

        $cbc =factory(User::class)->create([
            "name" => "Club Bàsquet Cantaires",
            "email" => "basquet_cantaires@univers.cat"
        ]);
        $cbc->assignRole('Alumnes');
        $cbc->assignRole('Activitats');

        $esplai =factory(User::class)->create([
            "name" => "Escola de l’Esplai Tortosa",
            "email" => "esplai@univers.cat"
        ]);
        $esplai->assignRole('Alumnes');
        $esplai->assignRole('Activitats');

        $xarxa =factory(User::class)->create([
            "name" => "Xarxa per la convivència a Tortosa",
            "email" => "xarxa_convivencia@univers.cat"
        ]);
        $xarxa->assignRole('Alumnes');
        $xarxa->assignRole('Activitats');

        $ampes =factory(User::class)->create([
            "name" => "AMPES",
            "email" => "ampes@univers.cat"
        ]);
        $ampes->assignRole('Alumnes');
        $ampes->assignRole('Activitats');

        $fapac =factory(User::class)->create([
            "name" => "FAPAC Terres de l’Ebre",
            "email" => "fapac@univers.cat"
        ]);
        $fapac->assignRole('Alumnes');
        $fapac->assignRole('Activitats');

        $pediatria = factory(User::class)->create([
            "name" => "Equips de pediatria de les àrees bàsiques de salut de Tortosa",
            "email" => "equips_pediatria@univers.cat"
        ]);
        $pediatria->assignRole('Alumnes');
        $pediatria->assignRole('Activitats');

        $voluntarisCaixa =factory(User::class)->create([
            "name" => "Voluntaris de “la Caixa”",
            "email" => "laCaixa@univers.cat"
        ]);
        $voluntarisCaixa->assignRole('Alumnes');
        $voluntarisCaixa->assignRole('Activitats');

        $bancSang =factory(User::class)->create([
            "name" => "Banc de Sang i Teixits",
            "email" => "banc_sang@univers.cat"
        ]);
        $bancSang->assignRole('Alumnes');
        $bancSang->assignRole('Activitats');

        $altres = factory(User::class)->create([
            "name" => "Altres Entitats",
            "email" => "altres@univers.cat"
        ]);
        $altres->assignRole('Alumnes');
        $altres->assignRole('Activitats');

        $voluntaris =factory(User::class)->create([
            "name" => "Voluntaries",
            "email" => "voluntari@univers.cat"
        ]);
        $voluntaris->assignRole('Alumnes');
        $voluntaris->assignRole('Activitats');
    }
}

if (!function_exists("migrate_activitats")){
    function migrate_activitats(){
        factory(Activitat::class)->create([
           "name" => "Taller Estudi asistit",
           "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Projecte Lector",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Redes",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Esplaia't Atzavara",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Reforç Creu Roja",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Ciberteca",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Reforç Punt Òmnia",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Tàndem",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Biblioteca Oberta",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "CRAI",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Invulnerable: reforç educatiu",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Ujaripén: Espai educatiu i de lleure",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Centre Obert Sant Francesc",
            "category" => "Éxit educatiu"
        ]);
        factory(Activitat::class)->create([
            "name" => "Classes d'árab",
            "category" => "Éxit educatiu"
        ]);
        //Igualtat d’oportunitats i Lleure

        factory(Activitat::class)->create([
            "name" => "Campus i casals d'estiu",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Colònies d'estiu",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Ujaripén: activitats d'estiu",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Rilleure – Invulnerables",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Esport a l’escola",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Invulnerables: activitats d’estiu",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Barça kids – Invulnerables",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Futbolnet – Invulnerables",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Creu Roja Joventut – Infància Hospitalitzada",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Creu Roja Joventut – Joguina Educativa",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);
        factory(Activitat::class)->create([
            "name" => "Menjadors infantils i activitats de lleure en període de vacances",
            "category" => "Igualtat d’oportunitats i Lleure"
        ]);

//        Participació comunitària
        factory(Activitat::class)->create([
            "name" => "ArtXiBarri",
            "category" => "Participació comunitària"
        ]);
        factory(Activitat::class)->create([
            "name" => "Marató de Sang",
            "category" => "Participació comunitària"
        ]);

        //Famílies
        factory(Activitat::class)->create([
            "name" => "Vincles conta-contes intergeneracional",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Recollida d’aliments",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Recollida material escolar",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Projecte Clara",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Mirades (espai dones)",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Menjador Social",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Casa d’Acollida",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Tallers del SIAD",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "SOAF",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Tallers Crèixer en familia",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Aprendre junts, créixer en familia (Invulnerables)",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Tallers dones Espai",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Llar d’infants Xino-Xano",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Sempre acompanyats",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Programa Actiu per majors de 65 anys",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "ASECG",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "BATA (UJARIPÉN)",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Xarxa Clau",
            "category" => "Famílies"
        ]);
        factory(Activitat::class)->create([
            "name" => "Acolliment lingüístic",
            "category" => "Famílies"
        ]);

        //Joves
        factory(Activitat::class)->create([
            "name" => "Oficina Jove: Àmbit Formació i Treball",
            "category" => "Joves"
        ]);
        factory(Activitat::class)->create([
            "name" => "Oficina Jove: Àmbit Salut",
            "category" => "Joves"
        ]);
        factory(Activitat::class)->create([
            "name" => "Oficina Jove:",
            "category" => "Joves"
        ]);
        factory(Activitat::class)->create([
            "name" => "Programa Garantia Juvenil",
            "category" => "Joves"
        ]);
        factory(Activitat::class)->create([
            "name" => "Projecte Transformem un raconet",
            "category" => "Joves"
        ]);
        factory(Activitat::class)->create([
            "name" => "Jornades de Voluntariat Juvenil",
            "category" => "Joves"
        ]);
        factory(Activitat::class)->create([
            "name" => "Xerrada– difusió activitats Espai Jove",
            "category" => "Joves"
        ]);
        factory(Activitat::class)->create([
            "name" => "Atzavara Jove",
            "category" => "Joves"
        ]);
        factory(Activitat::class)->create([
            "name" => "Programa Delegats i Delegades en 3D",
            "category" => "Joves"
        ]);
        factory(Activitat::class)->create([
            "name" => "Camps de treball",
            "category" => "Joves"
        ]);
    }
}

if (!function_exists('create_mysql_database')){
    function create_mysql_database($name){
        //PDO
        // MySQL : CREATE DATABASE IF NOT EXISTS $name
        $statement = "CREATE DATABASE IF NOT EXISTS $name";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}
if (!function_exists('drop_mysql_database')){
    function drop_mysql_database($name){
        //PDO
        // MySQL : DROP DATABASE IF NOT EXISTS $name
        $statement = "DROP DATABASE IF EXISTS $name";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}
if (!function_exists('create_mysql_user')){
    function create_mysql_user($name, $password = null, $host='localhost'){
        //PDO
        if (!$password) $password =str_random();
        $statement = "CREATE USER IF NOT EXISTS {$name}@{$host}";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        $statement = "ALTER USER '{$name}'@'{$host}' IDENTIFIED BY '{$password}'";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        return $password;
    }
}
if (!function_exists('grant_mysql_privileges')) {
    function grant_mysql_privileges($user, $database, $host = 'localhost')
    {
        //PDO
        $statement = "GRANT ALL PRIVILEGES ON {$database}.* TO '{$user}'@'{$host}' WITH GRANT OPTION";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        $statement = "FLUSH PRIVILEGES";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}
if (!function_exists('create_database')) {
    function create_database()
    {
        create_mysql_database(env('DB_DATABASE'));
        create_mysql_user(env('DB_USERNAME'),env('DB_PASSWORD'));
        grant_mysql_privileges(env('DB_USERNAME'),env('DB_DATABASE'));
    }
}
