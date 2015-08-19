<?php

namespace App;

use App\Contracts\Repositories\MediaInterface;
use Illuminate\Database\Eloquent\Model;

class Media extends Model implements MediaInterface
{
    //

    protected $guarded = [
      "id", "created_at", "updated_at"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
