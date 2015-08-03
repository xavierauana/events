<?php

use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name'      =>  'Xavier Au',
            'email'   =>  'xavier.au@anacreation.com',
            'password'   =>  bcrypt("aukaiyuen"),
        ];

        // Delete all record first
        DB::table('users')->truncate();

        // Uncomment the below to run the seeder
        DB::table('users')->insert($user);
    }
}
