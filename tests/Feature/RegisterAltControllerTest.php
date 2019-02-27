<?php

namespace Test\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;


class RegisterAltControllerTest extends TestCase
{
    use refreshdatabase;

    /**
     * @test
     */
    public function can_resgister_a_user()
    {


        //1
        initialize_roles();
        $this->assertNull(Auth::user());


        //2
        $response = $this->post( '/register_alt', $user = [
            'name' => 'Jose',
            'email' => 'jose@gmail.com',
            'password' => '123456',
            'password_confirmation' => '1234556'
        ]);

        //3

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $this->assertNotNull(Auth::user());

        //comprovar que se ha creado
        $this->assertEquals($user['email'], Auth::user()->email);
        $this->assertEquals($user['name'], Auth::user()->name);
//        $this->assertEquals(bcrypt($user->password),Auth::user()->password);
        $this->assertTrue(Hash::check($user['password'],Auth::user()->password));



    }





}
