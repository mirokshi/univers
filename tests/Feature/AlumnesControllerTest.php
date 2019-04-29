<?php
/**
 * Created by PhpStorm.
 * User: mirokshi
 * Date: 22/02/19
 * Time: 11:17
 */

namespace Tests\Feature;


use App\Alumne;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class AlumnesControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    //1) Guest_user
    //2) regular user -> No tiene nigun rol (pepe pringao)
    //3) super admin
    //2) AlumnesManager
    //4) Rol Alumnes

    /**
     * @test
     */
    public function guest_user_cannot_index_alumnes()
    {

        $response = $this->get('/alumnes');
        $response->assertRedirect('login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_index_alumnes()
    {
        $this->login();
        $response = $this->get('/alumnes');
        $response->assertStatus(403);
    }

  /**
   * @test
   */
    public function superadmin_can_index_alumnes()
    {
        create_example_simple_alumne();
        $this->loginAsSuperAdmin();
        $response = $this->get('alumnes');
        $response->assertSuccessful();
        $response->assertViewIs('alumnes');


        $response->assertViewHas('alumnes',function ($alumnes){
           return count($alumnes) === 4 &&
           $alumnes[0]['name'] === 'Juan';
        });

    }


    /**
     * @test
     */
    public function alumnes_user_can_index_alumnes()
    {
        create_example_simple_alumne();

        $user = $this->loginAsAlumnesUser();
        Alumne::create([
            'name' => 'Eje Alu',
            'user_id' => $user->id
        ]);

        $response = $this->get('/alumnes');
        $response->assertSuccessful();

        $response->assertViewIs('alumnes');
        $response->assertViewHas('alumnes', function($alumnes) {
            return count($alumnes)===1 &&
                $alumnes[0]['name']==='Eje Alu';
        });
        $response->assertViewHas('users');
        $response->assertViewHas('uri');
    }
}
