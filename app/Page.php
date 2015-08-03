<?php

namespace App;

use App\Contracts\Repositories\PageInterface;
use App\Entities\Layout;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements PageInterface
{
    protected $guarded = [
      "id","created_at","updated_at"
    ];

    public function getLayoutAttribute($value)
    {
        return new Layout($value);
    }

    public function contents()
    {
        return $this->hasMany('Content');
    }

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }
}
