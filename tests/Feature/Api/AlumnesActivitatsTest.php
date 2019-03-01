<?php
/**
 * Created by PhpStorm.
 * User: mirokshi
 * Date: 1/03/19
 * Time: 11:30
 */

namespace Tests\Feature\Api;


use App\Activitat;
use App\Alumne;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class AlumnesActivitatsTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function can_add_activitats_to_alumnes()
    {
        $this->withoutExceptionHandling();
        $this->loginAsAlumnesManager('api');

        //1
        $alumne = Alumne::create([
           'name'  => 'Juan'
        ]);
        $activitat =  Activitat::create([
           'name' => 'Karate'
        ]);
        $activitat2 =  Activitat::create([
            'name' => 'Museo'
        ]);

        //2


        $response = $this->json('PUT','/api/v1/alumnes/'.$alumne->id.'/activitats/',[
           'activitats'=>[$activitat->id,$activitat2->id]
        ]);

        $response->assertSuccessful();

        $alumne = $alumne->fresh();

        $this->assertCount(2,$alumne->activitats);
        $this->assertEquals('Karate',$alumne->activitats[0]->name);
        $this->assertTrue($alumne->activitats[0]->is($activitat));
        $this->assertEquals($alumne->activitats[0]->id,$activitat->id);
    }
}
