<?php

use Illuminate\Database\Seeder;
use App\Alumne;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        initialize_roles();
        create_primary_user();
        migrate_entitats();
        migrate_activitats();
        create_example_alumnes();
        create_example_alumnes_with_actvitats();

    }
}
