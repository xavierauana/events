<?php

namespace App;

use App\Contracts\Repositories\MenuItemInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MenuItem extends Model implements MenuItemInterface
{

    protected $table = "menu_items";

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function group()
    {
        return $this->belongsTo(MenuGroup::class);
    }

    public function getExternalUrlAttribute()
    {
        if($this->isExternalUrl())
        {
            return $this->url;
        }
    }

    public function getInternalUrlAttribute()
    {
        if($this->isInternalUrl())
        {
            return $this->url;
        }
    }

    private function isExternalUrl()
    {
        $interalPageUrls = $this->getInternalPageUrls();
        return !in_array($this->url, $interalPageUrls);
    }

    private function isInternalUrl()
    {
        $interalPageUrls = $this->getInternalPageUrls();
        return in_array($this->url, $interalPageUrls);
    }

    private function getInternalPageUrls()
    {
        $pages = Cache::get("pages");
        $internalPageUrls = [];

        foreach($pages as $page)
        {
            $internalPageUrls[] = "/".$page->url;
        }

        return $internalPageUrls;
    }
}
