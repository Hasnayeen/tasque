<?php

namespace Hasnayeen\Tasque;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hasnayeen\Tasque\BaseCommand;

class AddCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('add')
             ->setDescription('Add a work to the queue')
             ->setHelp("This command let you add new task to the queue, e.g \n$ tasque add 'Create a readme page'")
             ->addArgument('description', InputArgument::REQUIRED)
             ->addArgument('reminder')
             ->addArgument('status');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $created_at = date("Y-m-d H:i:s", time());
        $description = $input->getArgument('description');
        $reminder = $input->getArgument('reminder');
        $status = ($input->getArgument('status')) ? $input->getArgument('status') : 'Incomplete';
        $this->database->query(
            'insert into tasks(description,reminder,status,created_at) values(:description, :reminder, :status, :created_at)',
            compact('description','reminder','status','created_at')
        );
        $output->writeln('<info>Task added to the queue!</info>');
        $this->showTasks($output);
    }
}