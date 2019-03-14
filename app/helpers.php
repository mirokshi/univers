<?php

use App\Activitat;
use App\Alumne;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


if (!function_exists('logged_user')){
    function logged_user(){
        return json_encode(optional(Auth::user())->map());
    }
}

if (!function_exists('map_collection')){
    function  map_collection($collection){
        return $collection -> map(function ($item){
            return $item->map();
        });
    }
}

if (! function_exists('map_simple_collection')) {
    function map_simple_collection($collection)
    {
        return $collection->map(function($item) {
            return $item->mapSimple();
        });
    }
}
/**
 *
 */
if (!function_exists('create_role')) {
    function create_role($role)
    {
        try {
            return Role::create([
                'name' => $role
            ]);
        } catch(Exception $e) {
            return Role::findByName($role);
        }
    }
}
/**
 *
 */
if (!function_exists('create_permission')) {
    function create_permission($permission)
    {
        try {
            return Permission::create([
                'name' => $permission
            ]);
        } catch(Exception $e) {
            return Permission::findByName($permission);
        }
    }
}

if (!function_exists('initialize_roles')) {
    function initialize_roles() {
        $roles = [
            'AlumnesManager',
            'Alumnes',
            'ActivitatsManager',
            'Activitats',
        ];
        foreach ($roles as $role) {
            create_role($role);
        }
        $alumneManagerPermissions = [
            'alumnes.index',
            'alumnes.show',
            'alumnes.store',
            'alumnes.update',
            'alumnes.destroy'
        ];
        $activitatsManagerPermissions = [
            'activitats.index',
            'activitats.show',
            'activitats.store',
            'activitats.update',
            'activitats.destroy'
        ];
        $userAlumnePermissions = [
            'user.alumnes.index',
            'user.alumnes.show',
            'user.alumnes.store',
            'user.alumnes.update',
            'user.alumnes.destroy'
        ];
        $userActivitatsPermissions = [
            'user.activitats.index',
            'user.activitats.show',
            'user.activitats.store',
            'user.activitats.update',
            'user.activitats.destroy'
        ];


        $permissions = array_merge(
            $alumneManagerPermissions,
            $userAlumnePermissions,
            $activitatsManagerPermissions,
            $userActivitatsPermissions
        );

        foreach ($permissions as $permission) {
            create_permission($permission);
        }
        $rolePermissions = [
            'AlumnesManager' => $alumneManagerPermissions,
            'Alumnes' => $userAlumnePermissions,
            'ActivitatsManager' => $activitatsManagerPermissions,
            'Activitats' => $userActivitatsPermissions
        ];
        foreach ($rolePermissions as $role => $rolePermission) {
            $role = Role::findByName($role);
            foreach ($rolePermission as $permission) {
                $role->givePermissionTo($permission);
            }
        }
    }
}


if (!function_exists('initialize_gates')){
    function initialize_gates(){
        Gate::define('alumnes.manage',function ($user){
            return $user->isSuperAdmin() || $user->hasRole('AlumnesManager');
        });
        Gate::define('activitats.manage',function ($user){
            return $user->isSuperAdmin() || $user->hasRole('ActivitatsManager');
        })  ;
    }
}


if (!function_exists('create_primary_user')){
    function create_primary_user() {
        $user = User::where('email','mirokshirojas@tortosa.cat')->first();
        if (!$user) {

            $user =User::firstOrCreate ([
                'name' => 'Mirokshi Rojas',
                'email' => 'mirokshirojas@tortosa.cat',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD', 'secret'))
            ]);

                $user->admin = true;
                $user->save();


        }
    }
}

if (!function_exists('create_example_alumnes')) {

    function create_example_alumnes()
    {
        $user1 = factory(User::class)->create();
        Alumne::create([
            'name' => 'Jose',
            'surname' => 'Lopez',
            'birthdate' => date('d').'/'.date('m').'/'.date('Y'),
            'age' => 'dd',
            'school' => 'IES EBRE',
            'course' => date('Y').'-'.(date('Y')+1),
            'school_course' => 'CFGS',
            'sex' => 'altre',
            'phone' => '777888999',
            'user_id' => $user1->id
        ]);
        Alumne::create([
            'name' => 'Marc',
            'surname' => 'Mestre',
            'birthdate' => '22/10/2000',
            'age' => '23',
            'school' => 'IES EBRE',
            'course' => date('Y').'-'.(date('Y')+1),
            'school_course' => 'CFGS',
            'sex' => 'home',
            'phone' => '616531219',
            'user_id' => $user1->id
        ]);
        Alumne::create([
            'name' => 'Martha',
            'surname' => 'Ramirez',
            'birthdate' => '22/10/2000',
            'age' => '20',
            'school' => 'IES EBRE',
            'course' => date('Y').'-'.(date('Y')+1),
            'school_course' => 'CFGS',
            'sex' => 'dona',
            'phone' => '6564445152',
            'user_id' => $user1->id
        ]);

    }
}
if (!function_exists('create_example_simple_alumne')) {

    function create_example_simple_alumne()
    {
        Alumne::create([
            'name' => 'Juan',
            'surname' => 'Gutierrez Sanchez',
            'birthdate' => '22/10/2000',
            'age' => '19',
            'school' => 'IES EBRE',
            'course' =>date('Y').'-'.(date('Y')+1),
            'school_course' => 'CFGS',
            'sex' => 'home',
            'phone' => '616531219'
        ]);
        Alumne::create([
            'name' => 'Carla',
            'surname' => 'Garcia Gomez',
            'birthdate' => '22/10/2000',
            'age' => '19',
            'school' => 'IES EBRE',
            'course' =>date('Y').'-'.(date('Y')+1),
            'school_course' => 'CFGS',
            'sex' => 'dona',
            'phone' => '987654321'
        ]);
        Alumne::create([
            'name' => 'Joan',
            'surname' => 'Tiscar',
            'birthdate' => '22/10/2000',
            'age' => '20',
            'school' => 'IES EBRE',
            'course' =>date('Y').'-'.(date('Y')+1),
            'school_course' => 'CFGS',
            'sex' => 'home',
            'phone' => '123456789'
        ]);
        Alumne::create([
            'name' => 'Joan',
            'surname' => 'Tiscar',
            'birthdate' => '22/10/2000',
            'age' => '20',
            'school' => 'IES EBRE',
            'course' =>'2017-2018',
            'school_course' => 'CFGS',
            'sex' => 'home',
            'phone' => '123456789'
        ]);


    }

}

if (!function_exists('create_example_simple_activitat')) {

    function create_example_simple_activitat()
    {
        Activitat::create([
            'name' => 'Futbol',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' => date('Y').'-'.(date('Y')+1),
        ]);
        Activitat::create([
            'name' => 'Comedor',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' => date('Y').'-'.(date('Y')+1),
        ]);
        Activitat::create([
            'name' => 'Repaso',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' =>date('Y').'-'.(date('Y')+1),
        ]);
        Activitat::create([
            'name' => 'Natacion',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' =>date('Y').'-'.(date('Y')+1),
        ]);
        Activitat::create([
            'name' => 'Excursion',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' => date('Y').'-'.(date('Y')+1),
        ]);
        Activitat::create([
            'name' => 'Excursion',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' => date('Y').'-'.(date('Y')+1),
        ]);
    }
}

if (!function_exists('create_example_alumnes_with_actvitats')){
    function create_example_alumnes_with_actvitats(){
        $user1 = factory(User::class)->create();

        $alumne = Alumne::create([
           'name'=> 'Paco',
           'surname' => 'Diaz',
           'user_id' => $user1->id
        ]);

        $activitat1 = Activitat::create([
           'name' => 'A1'
        ]);
        $activitat2 = Activitat::create([
           'name'=> 'A2'
        ]);
        $activitat3 = Activitat::create([
            'name'=> 'A3'
        ]);

        $alumne->addActivitat($activitat1);
        $alumne->addActivitat($activitat2);
        $alumne->addActivitat($activitat3);

    }
}

if (!function_exists('calculateYears')) {
    function calculateYears($date1)
    {

            $d1 = $date1;
            $carbon =  Carbon::now();
            $d2 = $carbon;


        $diff = $d2->diff($d1);

        // Return years
        return $diff->y;
    }
}
