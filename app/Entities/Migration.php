<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:28 PM
 */

namespace App\Entities;

use Illuminate\Support\Facades\Schema;

/**
 * Class Migration
 *
 * The class responsible to create and drop db table related to layouts
 *
 * @package Acme\Entities
 */
class Migration {
    private $migrationDirectory;
    private $files;

    function __construct()
    {
        $this->setMigrationDirectory(database_path().'/migrations');
        $this->files = scandir($this->migrationDirectory);
    }

    /**
     * Set the migrations directory
     * @param string $migrationDirectory
     */
    public function setMigrationDirectory($migrationDirectory)
    {
        $this->migrationDirectory = $migrationDirectory;
    }


    /**
     * Create db table for layouts
     * Use layout name to name the db table such as
     * "sample_name" to "layout_sample_name"
     *
     * Check the table name is exit or not
     * It not call $this->createTable()
     *
     * @param $contentFields
     */
    public function createLayoutTables($contentFields)
    {
        foreach ($contentFields as $layout => $fields) {
            $tableName = "layout_$layout";
            if(!Schema::hasTable($tableName) and count($fields)>0) $this->createTable($tableName, $fields);
        }
    }
    public function createPartialTables($partialContentFields)
    {
        foreach ($partialContentFields as $layout => $fields) {
            $tableName = "partial_$layout";
            if(!Schema::hasTable($tableName) and count($fields)>0) $this->createTable($tableName, $fields);
        }
    }

    public function dropLayoutTable($layout)
    {
        Schema::dropIfExists("layout_$layout");
    }
    public function dropPartialTable($partial)
    {
        Schema::dropIfExists("partial_$partial");
    }

    private function createTable($tableName, $fields)
    {
        $type = substr($tableName,0, strpos($tableName, '_'));
        Schema::create($tableName, function ($table) use ($fields, $type) {
            $fieldNames = $fields['layout-content'];
            $fieldTypes = $fields['content-type'];
            $table->increments('id');

            $table->integer('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            if($type == 'layout')
            {
                $table->integer('page_id')->unsigned();
                $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            }
            foreach ($fieldNames as $index => $fieldName) {
                $table->$fieldTypes[$index]($fieldName);
            }
            $table->boolean('active');
            $table->timestamps();
        });
    }
}