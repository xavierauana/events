<?php

namespace App;

use App\Contracts\Repositories\PageInterface;
use App\Entities\Layout;
use App\Services\ParsingContentFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model implements PageInterface
{
    protected $guarded = [
      "id","created_at","updated_at"
    ];

    public function contents()
    {

    }

    public function template()
    {
        return $this->belongsTo(Template::class)->with("contentFields");
    }

    public function getLayoutAttribute($value)
    {
        return new Layout($value);
    }

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }
}
