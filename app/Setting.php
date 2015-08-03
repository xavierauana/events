<?php

namespace App;

use App\Contracts\Repositories\SettingInterface;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model implements SettingInterface
{
    protected $fillable = array(
        'display', 'code', 'value'
    );

}
