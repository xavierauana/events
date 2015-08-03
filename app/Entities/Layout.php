<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:22 PM
 */

namespace App\Entities;

use App\Services\ParsingContentFile;
use Illuminate\Support\Facades\File;

/**
 * Class Layout
 *
 * This class goes to predefined location.
 * Get all layout content fields marked in the file.
 * Convert those content fields, type and layout name to a standard convention.
 * Then create db tables for these layouts
 *
 * It also goes into the location and return files with predefine format
 *
 * The actual Database Actions is preform by Migration class.
 * The actual parsing actions is preform by Acme\Services\ParsingContentFile class
 *
 *
 * @package App\Entities
 */
class Layout {

    private $templateDirectory;
    private $partialsDirectory;
    private $layout;
    private $parser;

    /**
     * @var \App\Entities\Migration
     */
    private $migration;

    /**
     * @param null                     $layout
     * @param \App\Entities\Migration $migration
     */
    function __construct($layout = null)
    {
        $this->templateDirectory =  base_path('resources/views/front/pages');
        $this->partialsDirectory = base_path('resources/views/front/partials');
        if($layout) $this->layout = $layout;
        $this->migration = new Migration();
        $this->parser = new ParsingContentFile();
    }

    public function getLayout()
    {
        return $this->layout;
    }


    /**
     * @return array
     */
    public function getAllLayouts()
    {
        return $this->parseLayoutsFromFiles();
    }

    /**
     * @return array
     */
    public function getAllPartials()
    {
        return $this->parsePartialsFromFiles();
    }

    function __get($name)
    {
        $method = 'get'.$name;

        if(method_exists($this,$method))
        {
            return $this->$method();
        }else{
            throw new \Exception($name.'--No such property');
        }
    }


    /**
     * Convert single:abc.blade.php to Abc
     * and abc.blade.php to Abc
     *
     * @param $layout
     *
     * @return string
     */
    public function getDisplayName($layout=null)
    {
        if(!$layout) $layout = $this->layout;
        return $this->parser->getLayoutNameOnly($layout);
    }

    public function getType($checkLayout=null)
    {
        if( ! $layout = $checkLayout) $layout = $this->layout;
        return $this->getLayoutType();
    }

    /**
     * @return void
     */
    public function createLayoutTables()
    {
        $layouts = array_keys($this->getAllLayouts());
        $contentFields = $this->constructContentFields($layouts);
        $this->migration->createLayoutTables($contentFields);
    }
    /**
     * @return void
     */
    public function createPartialTables()
    {
        $partials = array_keys($this->getAllPartials());
        $contentFields = $this->constructContentFields($partials);
        $this->migration->createPartialTables($contentFields);
    }

    /**
     * @param $layout
     */
    public function dropLayoutTable($layout)
    {
        $layout = strtolower($this->getDisplayName($layout));
        $this->migration->dropLayoutTable($layout);
    }
    /**
     * @param $partial
     */
    public function dropPartialTable($partial)
    {
        $partial = strtolower($this->getDisplayName($partial));
        $this->migration->dropPartialTable($partial);
    }

    /**
     *
     */
    public function dropAllLayoutTables()
    {
        $layouts = array_keys($this->getAllLayouts());
        foreach($layouts as $layout)
        {
            $this->dropLayoutTable($layout);
        }
    }
    /**
     *
     */
    public function dropAllPartialTables()
    {
        $partials = array_keys($this->getAllPartials());
        foreach($partials as $partial)
        {
            $this->dropPartialTable($partial);
        }
    }

    /**
     *
     */
    public function refreshLayoutTables()
    {
        $this->dropAllLayoutTables();
        $this->createLayoutTables();
    }
    /**
     *
     */
    public function refreshPartialTables()
    {
        $this->dropAllPartialTables();
        $this->createPartialTables();
    }

    /**
     * @param null $layoutDirectory
     *
     * @return array
     */
    private function parseLayoutsFromFiles()
    {
        $layoutDirectory = $this->templateDirectory;
        $templates = File::files($layoutDirectory);
        $rawRecords = $this->parser->parseLayouts($templates);
        $refinedRecords = $this->removeChannelStructuralIndexPage($rawRecords);
        return $refinedRecords;
    }

    /**
     * @param null $layoutDirectory
     *
     * @return array
     */
    public function parsePartialsFromFiles()
    {
        $layoutDirectory = $this->partialsDirectory;
        $partials = File::files($layoutDirectory);
        $records = $this->parser->parsePartials($partials);
        return $records;
    }

    /**
     * @param $layout
     *
     * @return string
     */
    private function getLayoutType($checkLayout = null)
    {
        $layout =$this->layout;
        if($checkLayout) $layout = $checkLayout;
        return $this->parser->getLayoutType($layout);
    }

    /**
     * It goes into the layout file.
     * Find out the the "layout-content" and "content-type"
     *
     * if art "migration" set to be true, the some layout content type will be changed to meet the system requirement
     *
     * @param      $targetFile
     * @param bool $migration
     *
     * @return mixed
     */
    private function parseContentFields($targetFile, $migration=false)
    {
        $filePath = $this->getFile($targetFile);
        if(file_exists($filePath))
        {
            return $this->parser->parseContentFields($filePath, $migration);
        }
    }

    /**
     * @param $fileName
     * @param $partials
     * @param $simpleLayoutNames
     * @param $contentFields
     *
     * @return mixed
     */
    private function constructContentFields(array $fileName)
    {
        $contentFields = [];
        foreach ($fileName as $index => $file) {
            $name                 = strtolower($this->getDisplayName($file));
            $contentFields[$name] = $this->parseContentFields($file, true);
            $contentFields        = $this->addFieldsByLayoutType($contentFields, $file, $name);
        }
        return $contentFields;
    }

    public function getView($layout = null)
    {
        if(!$layout) $layout = $this->layout;
        return strtolower(str_replace('.blade.php', '', $layout));
    }

    /**
     * @param $contentFields
     * @param $layout
     * @param $layoutName
     *
     * @return mixed
     */
    private function addFieldsByLayoutType($contentFields, $layout, $layoutName)
    {
        $layoutType = $this->getLayoutType($layout);
        if ($layoutType == 'channel') {
            $contentFields[$layoutName]['layout-content'][] = 'published_date';
            $contentFields[$layoutName]['content-type'][]   = 'timestamp';
            $contentFields[$layoutName]['layout-content'][] = 'content_identifier';
            $contentFields[$layoutName]['content-type'][]   = 'string';
            return $contentFields;
        } elseif ($layoutType == 'structural') {
            $contentFields[$layoutName]['layout-content'][] = 'order';
            $contentFields[$layoutName]['content-type'][]   = 'integer';
            $contentFields[$layoutName]['layout-content'][] = 'content_identifier';
            $contentFields[$layoutName]['content-type'][]   = 'string';
            return $contentFields;
        }
        return $contentFields;
    }

    public function dropAllContentTables()
    {
        $this->dropAllLayoutTables();
        $this->dropAllPartialTables();
    }
    public function refreshContentTables()
    {
        $this->refreshLayoutTables();
        $this->refreshPartialTables();
    }
    public function createContentTables()
    {
        $this->createLayoutTables();
        $this->createPartialTables();
    }

    private function getFile($targetFile)
    {
        $file = $this->partialsDirectory.'/'.$targetFile;
        if(strpos($file,':')) $file = $this->templateDirectory.'/'.$targetFile;
        return $file;
    }

    public function getContentFields($checkLayout = null)
    {
        if(! $layout = $checkLayout) $layout = $this->layout;
        return $this->parseContentFields($layout);
    }

    /**
     *
     * Each structural and channel should/will come with a _index page.
     * Before go into the channel/structural content. There should be a layout serve as a sub index page to organise the channel/structural content.
     * The _index page will be remove from the raw record.
     * Because the _index page should not be selected as single page otherwise it should be a single layout
     *
     * @param $rawRecords
     *
     * @return array
     */
    private function removeChannelStructuralIndexPage($rawRecords)
    {
        $records = [];
        $layoutFullFileNames = array_keys($rawRecords);
        $layoutNames = [];
        foreach($layoutFullFileNames as $key)
        {
            $layoutNames[] = $this->parser->getLayoutNameOnly($key);
        }
        foreach($layoutFullFileNames as $key)
        {
            $layoutType = $this->parser->getLayoutType($key);
            if($layoutType == 'structural' or $layoutType == 'channel')
            {
                $layoutName = $this->parser->getLayoutNameOnly($key);
                if(in_array($layoutName.'_index', $layoutNames))
                {
                    $layout = $this->parser->getFullLayoutName($layoutName.'_index',$layoutType);
                    unset($rawRecords[$layout]);
                }
            }
        }
        $records = $rawRecords;
        return $records;
    }
}