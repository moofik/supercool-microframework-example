<?php

namespace Moofik\Framework\Http;

class Response
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $statusCode;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $cookies;

    /**
     * Response constructor.
     * @param string $content
     * @param int $statusCode
     * @param array $headers
     * @param array $cookies
     */
    public function __construct(string $content, int $statusCode = 200, array $headers = [], array $cookies = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->cookies = $cookies;
    }

    /**
     * Sends HTTP headers.
     *
     * @return $this
     */
    public function sendHeaders(): self
    {
        if (headers_sent()) {
            return $this;
        }

        foreach ($this->headers as $name => $value) {
            $replace = 0 === strcasecmp($name, 'Content-Type');
            header($name.': '.$value, $replace, $this->statusCode);
        }

        foreach ($this->cookies as $name => $cookie) {
            header('Set-Cookie: '.$name.strstr($cookie, '='), false, $this->statusCode);
        }

        return $this;
    }

    /**
     * Sends content for the current web response.
     *
     * @return $this
     */
    public function sendContent(): self
    {
        echo $this->content;

        return $this;
    }

    public function send(): void
    {
        $this->sendHeaders();
        $this->sendContent();
    }
}