<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:10 PM
 */

namespace App\Contracts\Repositories;


interface LanguageInterface {
    /**
     * @return \App\Contracts\Repositories\LanguageInterface
     */
    public function getDefaultLanguage();

    /**
     * @param $langId
     * @return LanguageInterface
     */
    public function getLanguageById($langId);

    /**
     * @param $langId
     * @return void
     */
    public function deleteLanguageById($langId);
}