<?php

namespace Hasnayeen\Tasque;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BaseCommand extends Command
{
    protected $database;

    public function __construct(DatabaseAdapter $database)
    {
        $this->database = $database;
        parent::__construct();
    }

    protected function showTasks(OutputInterface $output, $table = 'tasks')
    {
        $tasks = $this->database->fetchAll($table);
        if (!$tasks) {
            return $output->writeln('<info>No work left. Enjoy!</info>');
        }
        $table = new Table($output);
        $table->setHeaders(['Id', 'Description', 'reminder', 'status', 'created_at'])
              ->setRows($tasks)
              ->render();
    }
}