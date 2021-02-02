<?php
declare(strict_types=1);

namespace App\ResponseManager;

class ResponseConfig
{
    private int $statusCode;
    private array $body;
    private array $headers;

    public function __construct(array $body, int $statusCode = 200, array $headers = [])
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return ResponseConfig
     */
    public function setStatusCode(int $statusCode): ResponseConfig
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array $body
     * @return ResponseConfig
     */
    public function setBody(array $body): ResponseConfig
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return ResponseConfig
     */
    public function setHeaders(array $headers): ResponseConfig
    {
        $this->headers = $headers;
        return $this;
    }
}
