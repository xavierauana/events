<?php
/**
 * Author: Xavier Au
 * Date: 11/10/15
 * Time: 6:52 PM
 */

namespace App\Contracts\Entities;


/**
 * Interface SocialServiceInterface
 * @package App\Contracts\Entities
 */
interface SocialServiceInterface
{
    public function login();

    /**
     * @return array
     */
    public function constructPermissions();

    /**
     * @return string
     */
    public function loginURL();

}