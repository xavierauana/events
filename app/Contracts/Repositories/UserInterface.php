<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:20 PM
 */

namespace App\Contracts\Repositories;


interface UserInterface {
    /**
     * @param $userId
     *
     * @return UserInterface
     */
    public function getUserById($userId);

    /**
     * @param array $data
     *
     * @return UserInterface
     */
    public function updateUser(array $data);

    /**
     * This create new user with Hashed password
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createNewUser(array $data);
}