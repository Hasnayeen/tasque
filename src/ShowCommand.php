<?php

namespace Hasnayeen\Tasque;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hasnayeen\Tasque\BaseCommand;

class ShowCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('show')
             ->setDescription('Show all queued work');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->showTasks($output);
    }
}