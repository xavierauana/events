<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;
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

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UserTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(SettingTableSeeder::class);

        (new Initializer())->initialize();

        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Model::reguard();
    }
}
