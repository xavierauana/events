<?php
    /**
     * Author: Xavier Au
     * Date: 3/8/15
     * Time: 7:13 PM
     */

    namespace App\Services;


    use Illuminate\Support\Facades\Cache;

    class CacheService
    {
        public function put($key, $val, $duration)
        {
            Cache::put($key, $val, $duration);
       }

        public function get($key)
        {
            return Cache::get($key);
        }
        public function pull($key)
        {
            return Cache::pull($key);
        }

        public function forever($key, $val)
        {
            Cache::forever($key, $val);
        }
        public function rememberForever($key, $callback)
        {
            return Cache::rememberForever($key, $callback);
        }
        public function remember($key, $duration, $callback)
        {
            return Cache::remember($key, $duration, $callback);
        }

        public function has($key)
        {
            return Cache::has($key);
        }

        public function flush()
        {
            return Cache::flush();
        }
    }