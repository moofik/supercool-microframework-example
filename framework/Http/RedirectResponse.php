<?php

namespace Moofik\Framework\Http;

class RedirectResponse extends Response
{
    /**
     * RedirectResponse constructor.
     * @param string|null $url
     * @param int $status
     * @param array $headers
     * @param array $cookies
     */
    public function __construct(?string $url, int $status = 302, array $headers = [], array $cookies = [])
    {
        parent::__construct('', $status, $headers, $cookies);

        $this->headers['Location'] = $url;
    }
}
