<?php

namespace Moofik\Framework\Routing;

class Router
{
    /**
     * @var array
     */
    private $routesTable;

    /**
     * @param string $url
     * @param string $controller
     * @param string $method
     */
    public function get(string $url, string $controller, string $method): void
    {
        $prefix = 'GET:';
        $pattern = $this->getUrlRegexPattern($url);
        $key = $prefix . $pattern;

        $this->routesTable[$key]['_controller'] = $controller;
        $this->routesTable[$key]['_method'] = $method;
        $this->routesTable[$key]['_url'] = $url;
        $this->routesTable[$key]['_pattern'] = $pattern;
        $this->routesTable[$key]['_requestMethod'] = 'GET';
    }

    /**
     * @param string $url
     * @param string $controller
     * @param string $method
     */
    public function post(string $url, string $controller, string $method): void
    {
        $prefix = 'POST:';
        $pattern = $this->getUrlRegexPattern($url);
        $key = $prefix . $pattern;

        $this->routesTable[$key]['_controller'] = $controller;
        $this->routesTable[$key]['_method'] = $method;
        $this->routesTable[$key]['_url'] = $url;
        $this->routesTable[$key]['_pattern'] = $pattern;
        $this->routesTable[$key]['_requestMethod'] = 'POST';
    }

    /**
     * @param string $requestMethod
     * @param string $requestUri
     * @return FurtherExecutionPath
     */
    public function getExecutionPath(string $requestMethod, string $requestUri): FurtherExecutionPath
    {
        $arguments = null;

        foreach ($this->routesTable as $rule => $result) {
            if ($requestMethod !== $result['_requestMethod']) {
                continue;
            }

            if (preg_match($result['_pattern'], $requestUri, $matches)) {
                array_shift($matches);
                $arguments = $this->resolveNamedArguments($result['_url'], $matches);
                $controller = $result['_controller'];
                $method = $result['_method'];
                break;
            }
        }

        return new FurtherExecutionPath($controller, $method, $arguments);
    }

    /**
     * @param string $url
     * @return string
     */
    private function getUrlRegexPattern(string $url): string
    {
        $url = '#^' . $url . '$#';

        if (preg_match_all('#{(.*?)}#', $url, $matches)) {
            $url = preg_replace('#{.*?}#', '([^\/]?)', $url);
            $pos = strrpos($url, '?');

            if ($pos !== false) {
                $url = substr_replace($url, '', $pos, strlen('?'));
            }
        }

        return $url;
    }

    /**
     * @param string $urlPattern
     * @param array|null $values
     * @return array|null
     */
    private function resolveNamedArguments(string $urlPattern, ?array $values): ?array
    {
        if (null === $values || 0 === count($values)) {
            return null;
        }

        preg_match_all('#{(.*?)}#', $urlPattern, $matches);
        $keys = $matches[1];

        return array_combine($keys, $values);
    }
}