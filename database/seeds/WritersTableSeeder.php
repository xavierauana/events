<?php

use Illuminate\Database\Seeder;

class WritersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all record first
        DB::table('layout_writers')->truncate();

        for($i = 0; $i<20; $i++){
            $writer = [
                'lang_id' => 1,
                'meta_title' => "writer",
                'meta_description' => "Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming.",
                'page_id' => 4,
                'content_identifier' => "writer_$i",
                'active' => 1,
                'pic' => "http://lorempixel.com/1600/600/people",
                'thumbnail' => "http://lorempixel.com/400/300/people",
                'summary' => "this is the brief intro for writer",
                'intro' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad aliquam aperiam, consectetur debitis delectus dicta distinctio dolorum ea enim non odio placeat, quam quibusdam unde vero, voluptas voluptatibus? Accusantium alias amet, autem consectetur delectus dicta dignissimos esse id incidunt inventore ipsam maxime, provident quaerat quisquam quod sunt suscipit veritatis voluptas? A animi aperiam architecto dignissimos ducimus exercitationem, explicabo facilis id iste itaque labore maxime modi provident, quos, ratione recusandae repellendus sunt tenetur ut vero? Adipisci alias aliquam aliquid aperiam cumque delectus dignissimos dolorem doloribus et facere harum itaque mollitia nobis provident quia, repudiandae sint sit soluta temporibus vitae voluptatibus.",
            ];
            // Uncomment the below to run the seeder
            DB::table('layout_writers')->insert($writer);
        }


    }
}
