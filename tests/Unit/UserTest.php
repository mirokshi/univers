<?php

use App\Alumne;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase{

    use RefreshDatabase;



    /**
     * @test
     */
    public function user_tasks_return_null_when_no_tasks()
    {
        //1
        $user = factory(User::class)->create();

        //2
        $alumnes = $user->alumnes;
        //3
        $this->assertEmpty($alumnes);

    }
    /**
     * @test
     */
    public function can_add_alumne_to_user()
    {
        //1
        $user = factory(User::class)->create();
        $alumne1 = factory(Alumne::class)->create();
        $user->addAlumne($alumne1);

        //2
        $alumnes = $user->alumnes;
        //3
        $this->assertTrue($alumnes[0]->is($alumne1));

    }

 /**
  * @test
  */
    public function user_alumnes_returns_null_when_no_alumnes()
    {
        $user = factory(User::class)->create();

        $alumnes = $user -> alumnes;

        $this->assertEmpty($alumnes);
 }

    /**
     * @test
     */
    public function can_add_tasks_to_user()
    {
        //1
        $user = factory(User::class)->create();
        $alumne1 = factory(Alumne::class)->create();
        $alumne2 = factory(Alumne::class)->create();
        $alumne3 = factory(Alumne::class)->create();

        $alumnes = [];
        array_push($alumnes,$alumne1);
        array_push($alumnes,$alumne2);
        array_push($alumnes,$alumne3);

        $user-> addAlumnes($alumnes);

        //2
        $alumnes = $user->alumnes;
        //3
        $this->assertTrue($alumnes[0]->is($alumne1));

        $this->assertTrue($alumnes[1]->is($alumne2));
        $this->assertTrue($alumnes[2]->is($alumne3));

    }

    /**
     * @test
     */
    public function haveAlumne()
    {

        $user = factory(User::class)->create();
        $alumne = factory(Alumne::class)->create();
        //2 execute
        $user->addAlumne($alumne);
        $response= $user->haveAlumne($alumne);
        $this->assertEquals($alumne->map(), $response->map());

    }

    /**
     * @test
     */
    public function removeTask()
    {
        $user = factory(User::class)->create();
        $alumne = factory(Alumne::class)->create();
        //2 execute
        $user->addAlumne($alumne);
        $response = $user->haveAlumne($alumne);
        $this->assertEquals($alumne->map(), $response->map());
        $user->removeAlumne($alumne);
        $this->assertEmpty($user->tasks);
    }

    /**
     * @test
     */
    public function isSuperAdmin()
    {
        $user = factory(User::class)->create();

        $this->assertFalse($user->isSuperAdmin());
        $user->admin = true;
        $user->save();
        $this->assertTrue($user->isSuperAdmin());
    }


    /**
     * @test
     */
    public function regulars()
    {

        $this->assertCount(0,User::regular()->get());
        $user1 = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'Pepa Parda Jeans',
            'email' => 'pepaparda@jeans.com'
        ]);
        $user3 = factory(User::class)->create([
            'name' => 'Pepa Pig',
            'email' => 'pepapig@dibus.com'
        ]);
        $user3->admin = true;
        $user3->save();
        $this->assertCount(2,$regularusers = User::regular()->get());
        $this->assertEquals($regularusers[0]->name,'Pepe Pardo Jeans');
        $this->assertEquals($regularusers[1]->name, 'Pepa Parda Jeans');
    }


}


