<?php
namespace app\services;

use app\services\interfaces\IApiSource;

class ApiService
{
    private $source;

    /**
     * @param IApiSource $source
     */
    public function setSource(IApiSource $source): void
    {
        $this->source = $source;
    }

    /**
     * @param array $message
     * @param string $method
     * @return bool
     */
    public function send(array $message, string $method)
    {
        return $this->source->send($message, $method);
    }
}