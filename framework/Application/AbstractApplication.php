<?php

namespace Moofik\Framework\Application;

use Moofik\Framework\Container\Container;
use Moofik\Framework\Container\ArgumentResolver;
use Moofik\Framework\Http\Request;
use Moofik\Framework\Http\Response;
use Moofik\Framework\Routing\Router;

abstract class AbstractApplication
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var Container
     */
    private $container;

    /**
     * @var ArgumentResolver
     */
    private $argumentResolver;

    /**
     * AbstractApplication constructor.
     */
    public function __construct()
    {
        $this->container = new Container();
        $this->argumentResolver = new ArgumentResolver($this->container);
        $this->router = new Router();

        $this->registerRoutes($this->router);
        $this->registerClasses($this->container);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \ReflectionException
     */
    public function handle(Request $request): Response
    {
        $executionPath = $this->router->getExecutionPath($request);

        $controller = $executionPath->getController();
        $method = $executionPath->getMethod();
        $namedArguments = $executionPath->getUrlArguments();

        $classArguments = $this->argumentResolver->resolveMethodArguments($controller, $method, $namedArguments);
        $controllerInstance = $this->argumentResolver->buildClassInstance($controller);
        $response = $controllerInstance->$method(...$classArguments);

        if (!$response instanceof Response) {
            throw new \RuntimeException('Controller method must return Response instance.');
        }

        return $response;
    }

    /**
     * @return ArgumentResolver
     */
    public function getArgumentResolver(): ArgumentResolver
    {
        return $this->argumentResolver;
    }

    /**
     * @param Router $router
     */
    abstract protected function registerRoutes(Router $router): void;

    /**
     * @param Container $container
     */
    abstract protected function registerClasses(Container $container): void;
}