<?php

namespace App\Command;

use Atlas\Pdo\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDatabaseCommand extends Command
{
    protected static $defaultName = 'database:fill';

    /**
     * @var Connection
     */
    private $atlasConnection;

    /**
     * CreateDatabaseCommand constructor.
     * @param Connection $connection
     * @param string|null $name
     */
    public function __construct(Connection $connection, string $name = null)
    {
        parent::__construct($name);
        $this->atlasConnection = $connection;
    }


    protected function configure()
    {
        $this->setDescription('Recreate database');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->atlasConnection->beginTransaction();
        $this->atlasConnection->exec('CREATE TABLE tasks (id INTEGER PRIMARY KEY, author VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, description TEXT NOT NULL, is_completed BOOLEAN);');
        $this->atlasConnection->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, username VARCHAR(255) UNIQUE NOT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255), is_admin BOOLEAN);');
        $this->atlasConnection->perform("INSERT INTO users (username, password, is_admin) VALUES ('admin', :password, 1)", ['password' => password_hash('123', PASSWORD_DEFAULT)]);
        $this->atlasConnection->commit();
    }
}