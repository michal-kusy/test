<?php declare(strict_types=1);

namespace App\Http;

class Message
{
    public const METHOD_POST = 'POST';

    /** @var string */
    private $requestMethod;

    /** @var string */
    private $requestUrl;

    /** @var string[] */
    private $headers;

    /**
     * Message constructor.
     * @param string $requestMethod
     * @param string $requestUrl
     * @param string[] $headers
     */
    public function __construct(string $requestMethod, string $requestUrl, array $headers)
    {
        $this->requestMethod = $requestMethod;
        $this->requestUrl = $requestUrl;
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    /**
     * @return string
     */
    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }
}
