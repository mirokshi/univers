<?php

namespace Tests\Feature\Traits;

use App\User;
use Spatie\Permission\Models\Permission;

trait CanLogin
{
    /**
     * @param null $guard
     * @return mixed
     */
    protected function login($guard = null)
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,$guard);
        return $user;
    }
    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginAsUsingRole($guard,$role)
    {
        initialize_roles();
        $user = factory(User::class)->create();

        $roles = is_array($role) ? $role : [$role];
        foreach ($roles as $role) {
            $user->assignRole($role);
        }

        $this->actingAs($user,$guard);
        return $user;
    }

    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginAsAlumnesUser($guard = null)
    {
        return $this->loginAsUsingRole($guard,  'Alumnes');
    }

    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginAsAlumnesManager($guard = null)
    {
        return $this->loginAsUsingRole($guard, ['AlumnesManager', 'Alumnes']);
    }

    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginWithPermission($guard,$permission)
    {
        $user = factory(User::class)->create();
        Permission::create([
            'name' => $permission
        ]);
        $user->givePermissionTo($permission);
        $this->actingAs($user,$guard);
        return $user;
    }

    protected function loginAsSuperAdmin($guard = null)
    {
        $user = factory(User::class)->create();
        $user->admin = true;
        $user->save();
        $this->actingAs($user,$guard);
        return $user;
    }
}
