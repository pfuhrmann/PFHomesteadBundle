<?php

namespace PF\HomesteadBundle\Command;

use Laravel\Homestead\SshConfigCommand as BaseSshConfigCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SshConfigCommand extends BaseSshConfigCommand
{
    use MakeTrait;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('homestead:ssh-config');
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
