<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = cache('pages')->filter(function($page){
            return $page->url == "articles";
        })->first();
        // Delete all record first
        DB::table('layout_articles')->truncate();


        $photoType = [
            'abstract', "animal", "business", "cats", "city", "food", "nightlife", "fashion", "people", "nature", "sports", "technics", "transport"
        ];
        $dimensions = [
          "200", "300", "400"
        ];
        for($i = 0; $i < 20; $i++){
            $type = $photoType[rand(0,12)];
            $width = $dimensions[rand(0,2)];
            $height = $dimensions[rand(0,2)];


            $data = [
                'lang_id' => 1,
                'meta_title' => "Article $i",
                'meta_description' => "Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming.",
                'page_id' => $page->id,
                'content_identifier' => "article_$i",
                'writer_identifier' => "writer_".rand(0,20),
                'active' => true,
                'image1' => "http://lorempixel.com/$width/$height/$type",
                'summary' => "Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming.",
                'article' => "Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming. Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming. Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming. Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming. Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming. Lorem ipsum dolor sit amet, ea elit dolore urbanitas quo. Est assum cetero ei. Eam semper docendi id. Mucius doming.",
            ];

            DB::table('layout_articles')->insert($data);
        }
    }
}
