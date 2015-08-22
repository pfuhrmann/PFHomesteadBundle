<?php

namespace PF\HomesteadBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class BoxListCommand extends ContainerAwareCommand
{
    protected $basePath;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('homestead:box:list')
            ->setDescription('List available vagrant boxes');
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $command = 'vagrant box list';

        $process = new Process($command, realpath(__DIR__ . '/../'), array_merge($_SERVER, $_ENV), null, null);

        $process->run(function ($type, $line) use ($output) {
            $output->write($line);
        });
    }
}
