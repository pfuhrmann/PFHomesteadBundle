<?php

namespace PF\HomesteadBundle\Command;

use Laravel\Homestead\SshCommand as BaseSshCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SshCommand extends BaseSshCommand
{
    use MakeTrait;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('homestead:ssh');
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
