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
        DB::table('languages')->truncate();

        // Uncomment the below to run the seeder
        DB::table('languages')->insert($user);
    }
}
