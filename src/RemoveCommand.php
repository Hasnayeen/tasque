<?php

namespace Hasnayeen\Tasque;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hasnayeen\Tasque\BaseCommand;

class RemoveCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('remove')
             ->setDescription('Change status of task when its done')
             ->addArgument('id', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $this->database->query(
            'delete from tasks where id = :id',
            compact('id')
        );
        $deleted = $this->database->fetchAll('tasks');
        $output->writeln('<info>Task deleted</info>');
        $this->showTasks($output);
    }
}