<?php

namespace App;

use App\Contracts\Repositories\ContentInterface;
use App\Contracts\Repositories\PageInterface;
use App\Services\ParsingContentFile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Content extends Model implements ContentInterface
{

    protected $table = "";

    /**
     * @return array
     */
    public function getGuarded()
    {
        return $this->guarded;
    }

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function setFillable()
    {
        $fields = $this->showAllColumnName();
        foreach($fields as $object)
        {
            $this->fillable[] = $object->Field;
        }
    }
    public function showAllColumnName()
    {
        return DB::select('SHOW COLUMNS FROM '.$this->table);
    }

    /**
     * @return array
     */
    public function getFillable()
    {
        return $this->fillable;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }


    // Query Scope functions
    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }
    public function scopeIdentifier($query, $identifier)
    {
        return $query->whereContent_identifier($identifier);
    }
    public function scopeLanguage($query, $langId)
    {
        return $query->whereLang_id($langId);
    }
    public function scopePage($query, $pageId)
    {
        return $query->wherePage_id($pageId);
    }

    public function getContents(PageInterface $page)
    {
        $this->setTable((new ParsingContentFile())->getLayoutTableName($page->template->file));
        $contents = $this->wherePageId($page->id)->get();

        if(!count($contents)>0){
            $contents = $this->createInitialContent($page);
        }
        return $contents;
    }

    private function createInitialContent($page)
    {
        $languages = cache("active_languages");

        $collection = new Collection();
        $this->setTable((new ParsingContentFile())->getLayoutTableName($page->template->file));
        $this->create([
            "lang_id"=> 1,
            "page_id"=> 1,
        ]);
//        foreach($languages as $language){
//            $collection->add([
//                "lang_id"=>$language->id,
//                "page_id"=>$page->id
//            ]);
//            $collection->add($this->create([
//                "lang_id"=>$language->id,
//                "page_id"=>$page->id
//            ]));
//        }

        dd($collection);

        return $collection;

    }


}
