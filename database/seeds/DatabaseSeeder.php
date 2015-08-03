<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
    use Xavierau\RoleBaseAuthentication\database\Initializer;
    use Xavierau\RoleBaseAuthentication\database\seeds\PermissionTableSeeder;
    use Xavierau\RoleBaseAuthentication\database\seeds\RoleTableSeeder;

    class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(UserTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);

        Model::reguard();
    }
}
