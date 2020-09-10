<?php declare(strict_types=1);

namespace App\Http;

interface ResponseInterface
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

    public function send(): void;

    public function sendHeaders(): void;

    public function sendContent(): void;

    public function getContent(): string;
}
