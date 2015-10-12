<?php
/**
 * Author: Xavier Au
 * Date: 11/10/15
 * Time: 7:18 PM
 */

namespace App\Services\SocialIntegration;


use Facebook\FacebookRedirectLoginHelper;

class LaravelFacebookRedirectLoginHelper extends FacebookRedirectLoginHelper
{
    public $state;

    protected function storeState($state)
    {
        session('state', $state);
    }

    protected function loadState()
    {
        $this->state = session('state');
        return $this->state;
    }

}