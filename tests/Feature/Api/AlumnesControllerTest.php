<?php


namespace Tests\Feature\Api;

use App\Alumne;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Routing\Tests\Matcher\DumpedUrlMatcherTest;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class AlumnesControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;

    //CRUD -> CRU -> CREATE RETRIEVE UPDATE DELETE
    //BREAD -> PA -> BROWSER READ EDIT ADD DELETE

    // *********************** SHOW *******************************************************//

    /**
     * @test
     */
    public function alumne_manager_can_show_a_alumne()
    {
        $this->withoutExceptionHandling();

        $this->loginAsAlumnesManager('api');
        $alumne = factory(Alumne::class)->create();

        $response = $this->json('GET','/api/v1/alumnes/'.$alumne->id);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($alumne->name, $result->name);

    }

    /**
     * @test
     */
    public function superadmin_can_show_a_alumne()
    {

        $this->loginAsSuperAdmin('api');
        $alumne = factory(Alumne::class)->create();

        $response = $this->json('GET','/api/v1/alumnes/' . $alumne->id);

        $result = json_decode($response->getContent());

        $response->assertSuccessful();
        $this->assertEquals($alumne->name, $result->name);
    }

    /**
     * @test
     */
    public function regular_user_cannot_show_a_alumne()
    {
        $this->login('api');
        $alumne = factory(Alumne::class)->create();

        $response = $this->json('GET','/api/v1/alumnes/' . $alumne->id);
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function guest_user_cannot_show_a_alumne()
    {
        $alumne = factory(Alumne::class)->create();

        $response = $this->json('GET','/api/v1/alumnes/' . $alumne->id);
        $response->assertStatus(401);
    }


// *********************** DELETE *******************************************************//

/**
 * @test
 */
public function alumnes_manager_can_delete_alumne()
{

    $this->loginAsAlumnesManager('api');
    $alumne = factory(Alumne::class)->create();

    $response = $this->json('DELETE','/api/v1/alumnes/' . $alumne->id);
    $result = json_decode($response->getContent());

    $response->assertSuccessful();

    $this->assertEquals($result->name, $alumne->name);

    $this->assertNull(Alumne::find($alumne->id));

}

    /**
     * @test
     */
    public function superadmin_can_delete_alumne()
    {
        $this->loginAsAlumnesManager('api');
        $alumne = factory(Alumne::class)->create();

        $response = $this->json('DELETE','/api/v1/alumnes/' . $alumne->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($result->name, $alumne->name);

        $this->assertNull(Alumne::find($alumne->id));
    }

    /**
     * @test
     */
    public function regular_user_cannot_delete_alumne()
    {
        $this->login('api');
        $alumne = factory(Alumne::class)->create();

        $response = $this->json('DELETE','/api/v1/alumnes/' . $alumne->id);

        $result = json_decode($response->getContent());
        $response->assertStatus(403);
    }

    // *********************** CREATE *******************************************************//


    /**
     * @test
     */
    public function cannot_create_alumnes_without_name()
    {
//        $this->loginAsTaskManager('api');
        $this->loginWithPermission('api','alumnes.store');
        $response = $this->json('POST','/api/v1/alumnes/',[
            'name' => ''
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function superadmin_can_create_alumne()
    {
        $this->loginAsSuperAdmin('api');
        $response = $this->json('POST','/api/v1/alumnes/',[
            'name' => 'ExAlTe',
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        $this->assertNotNull($alumne = Alumne::find($result->id));

        $this->assertEquals('ExAlTe',$result->name);
    }

    /**
     * @test
     */
    public function superadmin_can_create_fullalumne()
    {
        $this->loginAsSuperAdmin('api');
        $user = factory(User::class)->create();
        $response = $this->json('POST','/api/v1/alumnes/',[
            'name'=>'Juan',
            'surname' =>'Gutierrez Sanchez',
            'birthdate' =>'22/10/2000',
            'age' =>'19',
            'school' =>'IES EBRE',
            'course' => '2018-2019',
            'school_course'=>'CFGS',
            'sex'=>'home',
            'phone'=>'616531219',
            'user_id' => $user->id
        ]);


        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertNotNull($task = Alumne::find($result->id));
        $this->assertEquals('Juan',$result->name);
        $this->assertEquals('Gutierrez Sanchez',$result->surname);
        $this->assertEquals('22/10/2000',$result->birthdate);
        $this->assertEquals('19',$result->age);
        $this->assertEquals('IES EBRE',$result->school);
        $this->assertEquals('2019-2020',$result->course);
        $this->assertEquals('CFGS',$result->school_course);
        $this->assertEquals('home',$result->sex);
        $this->assertEquals('616531219',$result->phone);
        $this->assertEquals($user->id,$result->user_id);


    }


    /**
     * @test
     */
    public function task_manager_can_create_task()
    {
        $this->loginAsAlumnesManager('api');

        $response = $this->json('POST','/api/v1/alumnes/',[
            'name' => 'Julio'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        $this->assertNotNull($task = Alumne::find($result->id));
        $this->assertEquals('Julio',$result->name);

    }

    /**
     * @test
     */
    public function regular_user_cannot_create_task()
    {
        $user = $this->login('api');

        $response = $this->json('POST','/api/v1/alumnes/',[
            'name' => 'Carmen'
        ]);

        $result = json_decode($response->getContent());
        $response->assertStatus(403);
    }

    // *********************** INDEX *******************************************************//


    /**
     * @test
     */
    public function regular_user_cannot_index_tasks()
    {
        $this->login('api');

        $response = $this->json('GET','/api/v1/alumnes');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_can_index_alumnes()
    {
        $this->loginAsSuperAdmin('api');

        create_example_alumnes();

        $response = $this->json('GET','/api/v1/alumnes');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3,$result);

        $this->assertEquals('Jose', $result[0]->name);
        $this->assertEquals('Lopez', $result[0]->surname);


        $this->assertEquals('Marc', $result[1]->name);
        $this->assertEquals('Mestre', $result[1]->surname);

        $this->assertEquals('Martha', $result[2]->name);
        $this->assertEquals('Ramirez', $result[2]->surname);

    }

    /**
     * @test
     */
    public function alumne_manager_can_index_alumnes()
    {
        $this->loginAsAlumnesManager('api');

        create_example_alumnes();

        $response = $this->json('GET','/api/v1/alumnes');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3,$result);

        $this->assertEquals('Jose', $result[0]->name);
        $this->assertEquals('Lopez', $result[0]->surname);


        $this->assertEquals('Marc', $result[1]->name);
        $this->assertEquals('Mestre', $result[1]->surname);

        $this->assertEquals('Martha', $result[2]->name);
        $this->assertEquals('Ramirez', $result[2]->surname);

    }


    // *********************** EDIT *******************************************************//

    /**
     * @test
     */
    public function regular_user_cannot_edit_alumne()
    {
        $this->login('api');

        $oldAlumne = factory(Alumne::class)->create([
            'name' => 'Manuel'
        ]);

        $response = $this->json('PUT','/api/v1/alumnes/' . $oldAlumne->id, [
            'name' => 'Martin'
        ]);

        json_decode($response->getContent());
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_can_edit_alumne()
    {
        $this->withoutExceptionHandling();
        $this->loginAsSuperAdmin('api');

        $oldAlumne = factory(Alumne::class)->create([
            'name' => 'Mario'
        ]);

        // 2
        $response = $this->json('PUT','/api/v1/alumnes/' . $oldAlumne->id, [
            'name' => 'Cesar'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        $newAlumne = $oldAlumne->refresh();
        $this->assertNotNull($newAlumne);
        $this->assertEquals('Cesar',$result->name);

    }

    /**
     * @test
     */
    public function alumne_manager_can_edit_alumne()
    {
        $this->loginAsAlumnesManager('api');

        $oldAlumne = factory(Alumne::class)->create([
            'name' => 'Carmen'
        ]);

        // 2
        $response = $this->json('PUT','/api/v1/alumnes/' . $oldAlumne->id, [
            'name' => 'Josefa'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        $newAlumne = $oldAlumne->refresh();
        $this->assertNotNull($newAlumne);
        $this->assertEquals('Josefa',$result->name);

    }

    /**
     * @test
     */
    public function cannot_edit_alumne_without_name()
    {
        $this->loginAsAlumnesManager('api');

        $oldAlumne = factory(Alumne::class)->create();
        $response = $this->json('PUT','/api/v1/alumnes/' . $oldAlumne->id, [
            'name' => ''
        ]);

        $response->assertStatus(422);
    }
}
