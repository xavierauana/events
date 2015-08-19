<?php
    use App\Services\CacheService;

    /**
     * Author: Xavier Au
     * Date: 3/8/15
     * Time: 7:04 PM
     */

function cache($key=null, $val=null, $duration=null)
{
    $defaultDuration = 10;
    $cacheService = new CacheService();
    if($key){
        if($val){
            if(!$duration) $duration = $defaultDuration;
            $cacheService->put($key, $val, $duration);
        }else{
            return $cacheService->get($key);

        }
    }
    return $cacheService;
}
