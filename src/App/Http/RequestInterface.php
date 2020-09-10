<?php

namespace App\Http;

use App\Exception\HttpRequestBodyStreamException;

interface RequestInterface
{
    /**
     * @return string
     */
    public function getRequestMethod(): string;

    /**
     * @return string
     */
    public function getRequestUrl(): string;

    /**
     * @return string[]
     */
    public function getHeaders(): array;

    /**
     * @return resource
     * @throws HttpRequestBodyStreamException
     */
    public function getBodyStream();

    /** @return mixed */
    public function getServer(string $key);
}
