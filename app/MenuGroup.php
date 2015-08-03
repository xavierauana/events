<?php

namespace App;

use App\Contracts\Repositories\MenuGroupInterface;
use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model implements MenuGroupInterface
{
    protected $table = "menu_groups";
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
