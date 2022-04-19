<?php

namespace app\services\interfaces;

interface IApiSource
{
    /**
     * @param array $message
     * @param string $method
     * @return bool
     */
    public function send(array $message, string $method);
}