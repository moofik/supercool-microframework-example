<?php

namespace Moofik\Framework\Routing;

class FurtherExecutionPath
{
    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $urlArguments;

    /**
     * FurtherExecutionPath constructor.
     * @param string $controller
     * @param string $method
     * @param array|null $urlArguments
     */
    public function __construct(string $controller, string $method, ?array $urlArguments)
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->urlArguments = $urlArguments;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getUrlArguments(): ?array
    {
        return $this->urlArguments;
    }
}