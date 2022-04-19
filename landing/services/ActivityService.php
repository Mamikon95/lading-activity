<?php
namespace app\services;

use app\services\ActivityApiService;

abstract class ActivityService
{
    const METHOD_ADD = 'add';
    const METHOD_GET = 'get';

    /**
     * @var ApiService
     */
    protected static $service;

    /**
     * Add new activity
     * @param string $url
     * @param string $date
     * @return bool
     */
    public static function newActivity(string $url, string $date)
    {
        return self::getService()->send(['url' => $url, 'date' => $date], self::METHOD_ADD);
    }

    /**
     * Get activity data list
     * @param int $page
     * @return bool
     */
    public static function getData(int $page = 1)
    {
        return self::getService()->send(['url' => $page], self::METHOD_GET);
    }

    /**
     * @return ApiService
     */
    public static function getService(): ApiService
    {
        if(self::$service === null)
        {
            self::$service = new ApiService();
            self::$service->setSource(new ActivityApiService());
        }

        return self::$service;
    }
}