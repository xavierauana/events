<?php

namespace App;

use App\Contracts\Repositories\ContentInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Content extends Model implements ContentInterface
{

    protected $table;

    function __construct($table=null)
    {
        if($table) $this->table = $table;
        parent::__construct();
    }

    /**
     * @return array
     */
    public function getGuarded()
    {
        return $this->guarded;
    }

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function setFillable()
    {
        $fields = $this->showAllColumnName();
        foreach($fields as $object)
        {
            $this->fillable[] = $object->Field;
        }
    }
    public function showAllColumnName()
    {
        return DB::select('SHOW COLUMNS FROM '.$this->table);
    }

    /**
     * @return array
     */
    public function getFillable()
    {
        return $this->fillable;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }


    // Query Scope functions
    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }
    public function scopeIdentifier($query, $identifier)
    {
        return $query->whereContent_identifier($identifier);
    }
    public function scopeLanguage($query, $langId)
    {
        return $query->whereLang_id($langId);
    }
    public function scopePage($query, $pageId)
    {
        return $query->wherePage_id($pageId);
    }
}
