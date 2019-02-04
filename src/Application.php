<?php

namespace App;

use App\Controller\LoginController;
use App\Controller\TaskController;
use Atlas\Orm\Atlas;
use Atlas\Pdo\Connection;
use Moofik\Framework\Application\AbstractApplication;
use Moofik\Framework\Container\Container;
use Moofik\Framework\Routing\Router;

class Application extends AbstractApplication
{
    /**
     * Template Method Pattern - реализуем абстрактные методы вызываемые из род. класса в наследнике
     * Регистрирует роуты
     * @param Router $router
     */
    protected function registerRoutes(Router $router): void
    {
        $router->get('/', TaskController::class, 'index');
        $router->get('/add', TaskController::class, 'add');
        $router->post('/add', TaskController::class, 'create');
        $router->get('/edit/{id}', TaskController::class, 'edit');
        $router->post('/edit/{id}', TaskController::class, 'save');
        $router->get('/login', LoginController::class, 'index');
        $router->post('/login', LoginController::class, 'login');
        $router->get('/logout', LoginController::class, 'logout');
    }

    /**
     * Template Method Pattern - реализуем абстрактные методы вызываемые из род. класса в наследнике
     * @param Container $container
     */
    protected function registerClasses(Container $container): void
    {
        $databaseConfig = require __DIR__ . '/../config/database.php';
        $pdoString = $databaseConfig['pdo'][0];

        /* Записываем инстанс ОРМки в контейнер как синглтон */
        $atlas = Atlas::new(
            $pdoString,
            '',
            ''
        );
        $container->setInstance(Atlas::class, $atlas);

        /* А так же коннекшн, тоже как синглтон, для нашего приложения это подходит */
        $connection = Connection::new(
            $pdoString,
            '',
            ''
        );
        $container->setInstance(Connection::class, $connection);
    }
}