<?php declare(strict_types=1);

namespace App\Http;

use App\Exception\HttpRequestBodyStreamException;

class Request extends Message implements RequestInterface
{

    /** @var string[] */
    private $query;

    /** @var string[] */
    private $form;

    /** @var mixed[][]  */
    private $files;

    /** @var mixed[] */
    private $server;

    /**
     * Request constructor.
     * @param string[] $headers
     * @param mixed[] $query
     * @param mixed[] $form
     * @param mixed[][] $files
     * @param mixed[] $server
     */
    public function __construct(
        string $requestMethod,
        string $requestUrl,
        array $headers,
        array $query,
        array $form,
        array $files,
        array $server
    ) {
        parent::__construct($requestMethod, $requestUrl, $headers);

        $this->query = $query;
        $this->form = $form;
        $this->files = $files;
        $this->server = $server;
    }


    public static function fromGlobal(): self
    {
        return new self($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], [], $_GET, $_POST, $_FILES, $_SERVER);
    }

    /**
     * @return resource
     * @throws HttpRequestBodyStreamException
     */
    public function getBodyStream()
    {
        $stream = fopen('php://input', 'rb');
        if ($stream === false) {
            throw new HttpRequestBodyStreamException("Error happened while opening php://input stream");
        }

        return $stream;
    }

    public function getServer(string $key)
    {
        return $this->server[$key] ?? null;
    }
}
