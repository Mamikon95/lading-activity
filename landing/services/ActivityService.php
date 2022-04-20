<?php
namespace app\services;

use app\services\ActivityApiService;

abstract class ActivityService
{
    const METHOD_ADD = 'add';
    const METHOD_GET = 'get';
    const METHOD_COUNT = 'count';

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
     * @param null $limit
     * @param int $offset
     * @return bool
     */
    public static function getData($limit = null, int $offset = 0)
    {
        return self::getService()->send(['limit' => $limit, 'offset' => $offset], self::METHOD_GET);
    }

    /**
     * Get all count
     * @return bool
     */
    public static function getCount()
    {
        return self::getService()->send([], self::METHOD_COUNT);
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