<?php
    /**
     * Author: Xavier Au
     * Date: 6/8/15
     * Time: 8:11 PM
     */

    namespace App\Services;


    use App\Contracts\Repositories\ContentInterface;
    use App\Contracts\Repositories\PageInterface;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Content extends Model implements ContentInterface
    {
        protected $table;
        protected $guarded = [
            'id', "created_at", "updated_at"
        ];

        public function scopeActive($query)
        {

            return $query->where('active', 1);

        }


        public function createRecord(array $data, $table=null)
        {
            if($table){
                $this->setTable($table);
            }
            foreach($data as $key=>$val){
                $this->$key = $val;
            }
            $this->save();
        }

        /**
         * @return mixed
         */
        public function getTable()
        {
            return $this->table;
        }

        /**
         * @param mixed $table
         */
        public function setTable($table)
        {
            $this->table = $table;
        }

        public function getContents(PageInterface $page)
        {
            $this->setTable((new ParsingContentFile())->getLayoutTableName($page->template->file));
            $result = $this->wherePageId($page->id)->get();
            return $result;
        }

        public function getFieldContent($code)
        {
            return $this->$code;
        }

        /**
         * Get active content with particular lang setting for front end view
         *
         * @param      $langId
         * @param null $table
         *
         * @return Collection
         */
        public function retrieveContentForFrontEndWithLangId($langId, $table = null)
        {
            if($table){
                $this->setTable($table);
            }
            return $this->whereLangId($langId)->whereActive(1)->get();
        }

        public function scopeSearch($query, $col, $val)
        {
            return $query->where($col, "like", "%$val%");
        }
    }