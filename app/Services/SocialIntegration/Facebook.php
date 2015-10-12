<?php
/**
 * Author: Xavier Au
 * Date: 11/10/15
 * Time: 6:55 PM
 */

namespace App\Services\SocialIntegration;


use App\Contracts\Entities\SocialServiceInterface;
use Facebook\Facebook as FB;

class Facebook implements SocialServiceInterface
{

    private $permissions;
    private $callBackUri = "fbLoginCallback";
    private $domain = "http://events.dev/";
    public $loginUrl;

    /**
     * Facebook constructor.
     */
    public function __construct()
    {
        $this->fb = new FB([
           'app_id' => env("FACEBOOK_ID"),
           'app_secret' => env("FACEBOOK_SECRET"),
           'default_graph_version' => 'v2.4',
       ]);

        $this->permissions = $this->constructPermissions();
        $this->loginUrl = $this->loginURL();
    }

    public function login()
    {
        $helper = $this->fb->getRedirectLoginHelper();
        dd($helper);
    }

    /**
     * @return array
     */
    public function constructPermissions()
    {
        $permissions = [
            'email'
        ];
        return $permissions;
    }

    /**
     * @return string
     */
    public function loginURL()
    {
        $helper = $this->fb->getRedirectLoginHelper();
        return $helper->getLoginUrl($this->domain.$this->callBackUri, $this->permissions);
    }
}