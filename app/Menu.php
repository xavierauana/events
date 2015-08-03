<?php

namespace App;

use App\Contracts\Repositories\MenuInterface;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model implements MenuInterface
{
    protected $guarded=[
        "id", "created_at", "updated_at"
    ];
}
