<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:23 PM
 */

namespace App\Services;


class ParsingContentFile {

    private $contentFields = array(
        'layout-content',
        'content-type'
    );

    private $replacement = array(
        'file'=>'string',
        'image'=>'string',
        'video'=>'string',
        'datetime'=>'timestamp',
        'richtext'=>'text',
        'checkbox'=>'boolean'
    );

    private $templateCategorySeparator=":";


    /**
     * Go through every layout and change their file name to a more readable layout name
     * The records key is the full file name and its corresponding value is modified name.
     * $records = ['single:sample_name:.blade.php'=>'Sample Name']
     *
     * TODO: this function need to refine
     * @param array $layouts
     *
     * @return array
     */
    public function parseLayouts(array $layouts)
    {
        $records = array();
        if(count($layouts)>0)
        {
            foreach($layouts as $layout) {
                if( preg_match('/(?<type>single|channel|structural)'.$this->templateCategorySeparator.'(?<name>\w+)(\.blade\.php)/i', $layout, $matches))
                {
                    $records[substr( $layout,strrpos($layout,'/')+1)] = ucwords(str_replace('_',' ', $matches['name']));
                }
            }
        }
        return $records;
    }

    public function parsePartials(array $partials)
    {
        $records = array();
        foreach($partials as $partial) {
            $key = substr($partial,strrpos($partial,'/')+1);
            $records[$key] = ucwords(str_replace('.blade.php','',$key));
        }
        return $records;
    }

    /**
     * Get the layout type from the file name.
     * From "single:sample.blade.php" get "single"
     *
     * @param $layout
     *
     * @return string
     */
    public function getLayoutType($layout)
    {
        $pos    = strpos($layout, $this->templateCategorySeparator);
        $type   = substr($layout,0, $pos);
        return $type;
    }


    /**
     * Go into the layout file, dig all content mark up
     * And construct a array
     *
     * @param $targetFile
     *
     * @param $forMigration
     *
     * @return mixed
     */
    public function parseContentFields($targetFile, $forMigration)
    {
        $content    =   array();
        $lines      =   file($targetFile, FILE_IGNORE_NEW_LINES);
        foreach($lines as $line)
        {
            if(preg_match('/'.$this->contentFields[0].'/i', $line))
            {
                for($i = 0; $i < count($this->contentFields); $i++)
                {
                    $patten = $this->contentFields[$i];
                    $layout_content = "/($patten=)/";
                    $testing = preg_split($layout_content,$line);
                    $potential = end($testing);

                    // the mark up "layout-content" or "content-type" should follow by " ", "|" or ">"
                    preg_match('/(\ |>)/',$potential,$matches,PREG_OFFSET_CAPTURE);
                    $pos            = $matches[0][1];
                    $key_or_value   = substr($potential, 1, $pos - 2);

                    // if the content type need to be replaced
                    // 'file', 'image', 'checkbox', 'audio' and 'video'
                    if($i == 1 and array_key_exists($key_or_value, $this->replacement) and $forMigration)
                    {
                        // replace the content type
                        // example: 'image' to 'string'
                        $key_or_value = $this->replaceFieldForDBMigration($key_or_value);
                    }
                    $content[$patten][] = $key_or_value;
                }
            }
        }
        return $content;
    }

    /**
     * Simplify the file name.
     * Change from "single:sample_layout.blade.php" to "Sample_layout"
     *
     * @param $name
     *
     * @return string
     */
    public function getLayoutNameOnly($name)
    {
        $shorterLayout = str_replace('.blade.php', '',$name);
        $removeColonString = $shorterLayout;
        if($pos = strpos($shorterLayout, $this->templateCategorySeparator)) $removeColonString = substr($shorterLayout, $pos+1);
        $properShortName = ucwords($removeColonString);
        return $properShortName;
    }

    /**
     * @param $key_or_value
     *
     * @return mixed
     */
    private function replaceFieldForDBMigration($key_or_value)
    {
        $keys         = array_keys($this->replacement);
        $index        = array_search($key_or_value, $keys);
        $key_or_value = $this->replacement[$keys[$index]];

        return $key_or_value;
    }

    /**
     *
     * Convert layout out name to it original full file name with layout type.
     * From "Sample_name" to "single:sample_name.blade.php"
     *
     * @param $layoutName
     * @param $layoutType
     *
     * @return string
     */
    public function getFullLayoutName($layoutName, $layoutType)
    {
        $name = strtolower($layoutName);
        $layoutType = strtolower($layoutType);
        $fullLayoutName = $layoutType.$this->templateCategorySeparator.$name.'.blade.php';
        return $fullLayoutName;
    }

    public function getLayoutTableName($layoutName)
    {
        return "layout_".strtolower($this->getLayoutNameOnly($layoutName));
    }
}