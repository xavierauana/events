<?php

namespace App;

use App\Entities\Layout;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $guarded=[
        "id", "created_at", "updated_at"
    ];

    public function contentFields()
    {
        return $this->hasMany(ContentField::class);
    }

    public function createAllPagesTemplateRecord()
    {
        $layouts = (new Layout())->getAllLayouts();
        $layouts = $this->checkDuplicateTemplate($layouts);

        $this->createRecords($layouts);
    }
    public function createAllPartialsTemplateRecord()
    {
        $partials = (new Layout())->getAllPartials();
        $partials = $this->checkDuplicateTemplate($partials);
        $this->createRecords($partials, "partial");
    }

    public function createRecords(array $fileInfo, $type=null)
    {
        foreach($fileInfo as $file=>$display){

            $data["file"]=$file;
            $data["display"]=$display;
            $data["type"]= $type? $type : strtolower(preg_split('/:/', $file)[0]);
            $data["view"]=str_replace(".blade.php","",$file);

            $this->create($data);
        }
    }

    /**
     * @param $layouts
     */
    private function checkDuplicateTemplate($layouts)
    {
        $templateCollection = $this->all();
        foreach ($templateCollection as $template) {
            foreach ($layouts as $file => $display) {
                if ($template->file == $file) unset($layouts[$file]);
            }
        }
        return $layouts;
    }
}
