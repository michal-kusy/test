<?php declare(strict_types=1);

namespace App\Http;

use App\Exception\JsonException;

class JsonResponse extends Response
{
    /** @var mixed */
    private $payload;

    /**
     * @param mixed $payload
     */
    public function __construct(
        $payload,
        int $statusCode,
        string $statusText,
        string $requestMethod,
        string $requestUrl,
        array $headers
    ) {
        parent::__construct($statusCode, $statusText, $requestMethod, $requestUrl, $headers);
        $this->payload = $payload;

        $this->addHeader(self::HEADER_CONTENT_TYPE, self::MIME_JSON);
    }

    /**
     * @throws JsonException
     */
    public function sendContent(): void
    {
        $json = json_encode($this->payload);
        if ($json === false) {
            throw new JsonException(json_last_error_msg(), json_last_error());
        }

        echo $json;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     */
    public function setPayload($payload): void
    {
        $this->payload = $payload;
    }
}
