<?php

namespace Moofik\Framework\Container;

class ArgumentResolver
{
    /**
     * @var Container
     */
    private $container;

    /**
     * ArgumentResolver constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Возвращает массив аргументов необходимых для вызова метода
     * @param string $class
     * @param string $method
     * @param array|null $namedArguments
     * @return array
     */
    public function resolveMethodArguments(string $class, string $method, ?array $namedArguments): array
    {
        $arguments = [];

        try {
            $reflectionClass = new \ReflectionClass($class);
            $reflectionMethod = $reflectionClass->getMethod($method);
            $parameters = $reflectionMethod->getParameters();

            foreach ($parameters as $parameter) {
                /* Если параметр - класс , то пробуем его создать */
                if ($parameter->getClass()) {
                    $arguments[] = $this->buildClassInstance($parameter->getClass()->getName());
                } else {
                    /* В противном случае, параметр - примитив, а значит должен быть в списке namedArguments
                     * Пробуем достать его оттуда
                     */
                    $arguments[] = $namedArguments[$parameter->name];
                }
            }
        } catch (\ReflectionException $exception) {
            throw new ArgumentResolverException($exception->getMessage());
        }

        return $arguments;
    }

    /**
     * @param string $class
     * @return mixed
     */
    public function buildClassInstance(string $class)
    {
        $containerBinding = $this->container->get($class);

        if (is_object($containerBinding)) {
            return $containerBinding;
        } elseif (is_string($containerBinding)) {
            $class = $containerBinding;
        } elseif (is_callable($containerBinding)) {
            return $containerBinding();
        }

        try {
            $arguments = [];
            $reflectionClass = new \ReflectionClass($class);
            $reflectionConstructor = $reflectionClass->getConstructor();

            if ($reflectionConstructor) {
                $parameters = $reflectionConstructor->getParameters();
                /* Смотрим параметры методы */
                foreach ($parameters as $parameter) {
                    /* Если это класс то пробуем его создать */
                    if ($parameter->getClass()) {
                        $arguments[] = $this->buildClassInstance($parameter->getClass()->getName());
                    } elseif ($parameter->isOptional()) {
                        /* Если параметр опциональный - пропускаем */
                        continue;
                    } else {
                        throw new ArgumentResolverException('Primitives is not supported yet.');
                    }
                }
            }

            $instance = new $class(...$arguments);
        } catch (\ReflectionException $exception) {
            throw new ArgumentResolverException($exception->getMessage());
        }

        return $instance;
    }
}
