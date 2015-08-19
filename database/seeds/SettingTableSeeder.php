<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'display'      =>  'Default Language',
                'code'   =>  'default_language',
                'value'   =>  'en'
            ],
            [
                'display'      =>  'Timezone',
                'code'   =>  'timezone',
                'value'   =>  'Asia/Hong_Kong'
            ],

        ];

        // Delete all record first
        DB::table('settings')->truncate();

        // Uncomment the below to run the seeder
        foreach($settings as $setting){
            DB::table('settings')->insert($setting);
        }
    }
}
