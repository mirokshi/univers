<?php
/**
 *
 */

use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
