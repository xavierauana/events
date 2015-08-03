<?php

namespace App;

use App\Contracts\Repositories\LanguageInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Language extends Model implements LanguageInterface
{
    protected $fillable = [
        'code',
        'display',
        'active',
        'default'
    ];

    /**
     * @return \App\Contracts\Repositories\LanguageInterface
     */
    public function getDefaultLanguage()
    {
        $object = $this;
        $language = Cache::rememberForever('default_language', function()use($object){
            return  $object->whereDefault(1)->first();
        });
        return $language;
    }

    /**
     * @param $langId
     *
     * @return LanguageInterface
     */
    public function getLanguageById($langId)
    {
        $language = $this->findOrFail($langId);
        return $language;
    }

    /**
     * @param $langId
     *
     * @return void
     */
    public function deleteLanguageById($langId)
    {
        $language = $this->getLanguageById($langId);
        $language->delete();
    }
}
