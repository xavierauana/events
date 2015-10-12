<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = cache('pages')->filter(function($page){
           return $page->url == "events";
        })->first();
        // Delete all record first
        DB::table('layout_events')->truncate();


        $photoType = [
            'abstract', "animal", "business", "cats", "city", "food", "nightlife", "fashion", "people", "nature", "sports", "technics", "transport"
        ];
        $months = [
            "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"
        ];

        $catList = [
            'Dance', "Drama", "Sport", "Party"
        ];

        foreach($months as $month){
            for($day = 1; $day <= (int) date('t', strtotime("2015-$month")); $day++){
                $number = rand(0,5);
                if($day<10){
                    $date = "0$day";
                }else{
                    $date = $day;
                }
                if($number>0){
                    for($i = 0; $i<$number; $i++){
                        $type = $photoType[rand(0,12)];
                        $cat = $catList[rand(0,3)];
                        $startDate = Carbon::create(2015,$month,$date);
                        $endDate = Carbon::create(2015,$month,$date)->addDays(rand(1,5));
                        $data = [
                            'lang_id' => 1,
                            'meta_title' => "Event $i on day $day",
                            'meta_description' => "Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming.",
                            'page_id' => $page->id,
                            'content_identifier' => "event_seeder_$month-$day-$i",
                            'active' => 1,
                            'eventStartDate' => $startDate->format("Y-m-d h:i:s"),
                            'eventEndDate' => $endDate->format("Y-m-d h:i:s"),
                            'address' => "hong Kong",
                            'image1' => "http://lorempixel.com/380/300/$type",
                            'image2' => "http://lorempixel.com/380/300/$type",
                            'image3' => "http://lorempixel.com/380/300/$type",
                            'image4' => "http://lorempixel.com/380/300/$type",
                            'summary' => "this is the summary for a $cat event $i on $date $month",
                            'detail' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad aliquam aperiam, consectetur debitis delectus dicta distinctio dolorum ea enim non odio placeat, quam quibusdam unde vero, voluptas voluptatibus? Accusantium alias amet, autem consectetur delectus dicta dignissimos esse id incidunt inventore ipsam maxime, provident quaerat quisquam quod sunt suscipit veritatis voluptas? A animi aperiam architecto dignissimos ducimus exercitationem, explicabo facilis id iste itaque labore maxime modi provident, quos, ratione recusandae repellendus sunt tenetur ut vero? Adipisci alias aliquam aliquid aperiam cumque delectus dignissimos dolorem doloribus et facere harum itaque mollitia nobis provident quia, repudiandae sint sit soluta temporibus vitae voluptatibus.",
                            'cat' => $cat
                        ];
                        DB::table('layout_events')->insert($data);
                    }
                }
            }
        }
    }
}
