<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Repositories\ContentInterface;
use Illuminate\Support\Facades\App;

class Favorite extends Model
{
    protected $fillable = [
      'user_id', 'type', 'content_identifier'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getEventAttribute(){
        $table = "layout_events";
        $content = App::make(ContentInterface::class);
        return $content->retrieveChannelContentForFrontEndWithLangId(1, $table, $this->content_identifier);
    }

}
