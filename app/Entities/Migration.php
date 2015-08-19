<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:28 PM
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
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
            if(!Schema::hasTable($tableName) and count($fields)>0) $this->createTable($tableName,"layout", $fields);
        }
    }
    public function createPartialTables($partialContentFields)
    {
        foreach ($partialContentFields as $layout => $fields) {
            $tableName = "partial_$layout";
            if(!Schema::hasTable($tableName) and count($fields)>0) $this->createTable($tableName,"partial", $fields);
        }
    }
    public function createLayoutTablesOnly($layouts)
    {
        foreach ($layouts as $layout) {
            $tableName = "layout_".strtolower($layout->display);
            $type = $layout->type;
            if(!Schema::hasTable($tableName)) $this->createTable($tableName, $type);
        }
    }
    public function createPartialTablesOnly($partials)
    {
        foreach ($partials as $partial) {
            $tableName = "partial_".strtolower($partial->display);
            if(!Schema::hasTable($tableName)) $this->createTable($tableName, "partial");
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

    private function createTable($tableName, $type, $fields=null)
    {

        Schema::create($tableName, function ($table)use($type) {
            $table->increments('id');
            $table->integer('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            if($type <> 'partial')
            {
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->integer('page_id')->unsigned();
                $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');

                if($type !== "single"){
                    $table->string('content_identifier');
                    if($type=="structural") $table->integer('order');
                    if($type=="channel") $table->timestamp('publish_date')->default(DB::raw('CURRENT_TIMESTAMP'));
                }
            }
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        if($fields){
            $this->addTableColumns($tableName, $fields);
        }

    }

    /**
     * @param $tableName
     * @param $fields
     */
    private function addTableColumns($tableName, $columns)
    {
        Schema::table($tableName, function ($table) use ($columns) {
            $fieldNames = $columns['layout-content'];
            $fieldTypes = $columns['content-type'];
            foreach ($fieldNames as $index => $fieldName) {
                $table->$fieldTypes[$index]($fieldName)->nullable();
            }
        });
    }

    public function addColumns($tableName, $columns)
    {
        if($columns instanceof Collection){
            foreach ($columns as $column) {
                if ( ! Schema::hasColumn($tableName, $column)) {
                    Schema::table($tableName, function ($table) use ($column) {
                        $columnType = convertInputTypeToDbType($column->type);
                        $columnName = $column->code;
                        $table->$columnType($columnName)->nullable();
                    });
                }
            }
        }
        if(is_array($columns)){
            foreach ($columns as $column) {
                if ( ! Schema::hasColumn($tableName, $column['code'])) {
                    Schema::table($tableName, function ($table) use ($column) {
                        $columnType = convertInputTypeToDbType($column["type"]);
                        $columnName = $column["code"];
                        $table->$columnType($columnName)->nullable();
                    });
                }
            }
        }
    }

    public function dropColums($tableName, $columns)
    {
        $tempColumns = [];

        if( $columns instanceof Collection){
            foreach($columns as $column){
                $tempColumns[] = $column->code;
            }
        }

        if(is_array($columns))
        {
            foreach($columns as $column){
                $tempColumns[] = $column["code"];
            }
        }

        foreach($tempColumns as $targetColumn){
            if (Schema::hasColumn($tableName, $targetColumn)) {
                Schema::table($tableName, function ($table)use($targetColumn) {
                    $table->dropColumn($targetColumn);
                });
            }
        }



    }
}