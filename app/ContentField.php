<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentField extends Model
{
    protected $table = "content_fields";
    protected $guarded = [
        "id", "created_at", "updated_at"
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
