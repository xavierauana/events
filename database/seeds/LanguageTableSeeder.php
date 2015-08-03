<?php

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'code'      =>  'en',
            'display'   =>  'English',
            'default'   =>  1,
            'active'   =>  1
        ];

        // Delete all record first
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('languages')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Uncomment the below to run the seeder
        DB::table('languages')->insert($user);
    }
}
