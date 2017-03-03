<?php

namespace Hasnayeen\Tasque;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hasnayeen\Tasque\BaseCommand;

class DoneCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('done')
             ->setDescription('Change status of task when its done')
             ->addArgument('id', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $status = 'Complete';
        $this->database->query(
            'update tasks set status = :status where id = :id',
            compact('id', 'status')
        );
        $completed = $this->database->fetchAll('tasks');
        $output->writeln('<info>Task completed</info>');
        $this->showTasks($output);
    }
}