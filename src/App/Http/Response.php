<?php declare(strict_types=1);

namespace App\Http;

class Response extends Message implements ResponseInterface
{

    public const HEADER_CONTENT_TYPE = 'Content-Type';
    public const MIME_JSON = 'application/json';
    public const STATUS_OK = 200;
    public const STATUS_BADREQUEST = 400;
    public const STATUS_UNAUTHORIZED = 401;

    /** @var int */
    private $statusCode;

    /** @var string */
    private $statusText;

    /** @var string */
    private $content;

    public function __construct(
        int $statusCode,
        string $statusText,
        string $requestMethod,
        string $requestUrl,
        array $headers,
        string $content = ''
    ) {
        parent::__construct($requestMethod, $requestUrl, $headers);
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
        $this->content = $content;
    }


    public function send(): void
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    public function sendHeaders(): void
    {
        if (headers_sent()) {
            return;
        }

        header(sprintf('HTTP/1.1 %s %s', $this->statusCode, $this->statusText), true, $this->statusCode);
        foreach ($this->getHeaders() as $key => $value) {
            header(sprintf('%s: %s', $key, $value), true);
        }
    }

    public function sendContent(): void
    {
        echo $this->content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content ?? '';
    }
}
