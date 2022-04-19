<?php

namespace app\services;

use yii;
use yii\httpclient\Client;
use app\services\interfaces\IApiSource;

class ActivityApiService implements IApiSource
{
    protected string $url;

    public function __construct()
    {
        $this->setUrl(yii::$app->params['activityApiUrl']);
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param array $message
     * @param string $method
     */
    public function send(array $message, string $method)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setFormat(Client::FORMAT_JSON)
            ->setMethod('POST')
            ->setUrl($this->url)
            ->setData([
                'jsonrpc' => '2.0',
                'id' => '1',
                'method' => $method,
                'auth' => yii::$app->params['activityApiToken'],
                'params' => [$message],
            ])->send();

        return $response->getData();
    }
}