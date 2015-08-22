<?php

namespace PF\HomesteadBundle\Command;

use Laravel\Homestead\DestroyCommand as BaseDestroyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DestroyCommand extends BaseDestroyCommand
{
    use MakeTrait;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('homestead:destroy');
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getHelper('dialog');
        if (!$dialog->askConfirmation(
            $output,
            '<question>This will delete VM and all data! Continue?</question>',
            false
        )
        ) {
            return;
        }

        $this->execMake($output);
        parent::execute($input, $output);
    }
}
