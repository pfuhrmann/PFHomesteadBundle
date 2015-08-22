<?php

namespace PF\HomesteadBundle\Command;

use Laravel\Homestead\UpdateCommand as BaseUpdateCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends BaseUpdateCommand
{
    use MakeTrait;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('homestead:update');
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
