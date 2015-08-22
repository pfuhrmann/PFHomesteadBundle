<?php

namespace PF\HomesteadBundle\Command;

use Laravel\Homestead\StatusCommand as BaseStatusCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StatusCommand extends BaseStatusCommand
{
    use MakeTrait;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('homestead:status');
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->execMake($output);
        parent::execute($input, $output);
    }
}
