<?php

namespace PF\HomesteadBundle\Command;

use Laravel\Homestead\SuspendCommand as BaseSuspendCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SuspendCommand extends BaseSuspendCommand
{
    use MakeTrait;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('homestead:suspend');
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
