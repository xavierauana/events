<?php
    /**
     * Author: Xavier Au
     * Date: 11/8/15
     * Time: 10:58 AM
     */

    namespace App\Services;


    use App\Contracts\Repositories\SettingInterface;
    use Illuminate\Support\Facades\App;

    class ManageSettingService
    {
        private $setting;

        /**
         * ManageSettingService constructor.
         *
         * @param $setting
         */
        public function __construct()
        {
            $this->setting = App::make(SettingInterface::class);
        }

        public function set($code, $value)
        {
            $setting = $this->setting->whereCode($code)->firstOrFail();
            $setting->value = $value;
            $setting->save();
            return $setting;
        }

        public function get($code)
        {
            $setting = $this->setting->whereCode($code)->firstOrFail();
            return $setting->value;
        }

    }