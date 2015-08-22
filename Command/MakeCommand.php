<?php

namespace PF\HomesteadBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class MakeCommand extends ContainerAwareCommand
{
    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var Filesystem
     */
    protected $fs;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->basePath = getcwd();
        $this->fs = new Filesystem();

        $this->setName('homestead:make')
            ->setDescription('Install Homestead into the current project')
            ->addOption('after', null, InputOption::VALUE_NONE, 'Determines if the after.sh file is created.');
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->config = $this->getContainer()->getParameter('pf.homestead.configuration');
        $localPath = __DIR__ . '/../';
        $yamlPath = $localPath . 'Homestead.yaml';

        $this->initVagrantfile();
        $this->initHomesteadYml($yamlPath);

        // Check if we have new version of the config
        $currentConfig = Yaml::parse(file_get_contents($yamlPath));
        if ($currentConfig !== $this->config) {
            $this->dumpHomesteadFile($yamlPath);
            $this->prepareProvision($localPath);
        }

        // Init after
        if ($input->getOption('after')) {
            $this->initAfterSh();
        }
    }

    /**
     * Create Vagrantfile
     */
    private function initVagrantfile()
    {
        if (!$this->fs->exists($this->basePath . '/Vagrantfile')) {
            $this->fs->copy(__DIR__ . '/stubs/LocalizedVagrantfile', $this->basePath . '/Vagrantfile');
            $this->output->writeln('<comment>Vagrantfile created in the root</comment>');
        }
    }

    /**
     * Create Homestead.yaml
     *
     * @param string $yamlPath
     */
    private function initHomesteadYml($yamlPath)
    {

        if (!$this->fs->exists($yamlPath)) {
            $this->dumpHomesteadFile($yamlPath);
        }
    }

    /**
     * Prepare provisioning for Symfony Nginx conf
     *
     * @param string $localPath
     */
    private function prepareProvision($localPath)
    {
        $sites = $this->config['sites'];
        $cmd = '#!/bin/sh' . PHP_EOL;
        foreach ($sites as $site) {
            $nginxPath = '/etc/nginx/sites-available/' . $site['map'];
            $cmd .= 'sudo cp ' . $site['to'] . '/../vendor/pfuhrmann/homestead-bundle/Command/stubs/nginx.conf ' . $nginxPath . PHP_EOL;
            $cmd .= "sudo sed -i 's|homestead.app|" . $site['map'] . "|g' " . $nginxPath . PHP_EOL;
            $cmd .= "sudo sed -i 's|/home/vagrant/homestead/web|" . $site['to'] . "|g' " . $nginxPath . PHP_EOL;
            $this->output->writeln('<comment>Provisioning for Nginx vhost:' . $site['map'] . ' prepared</comment>');
        }

        $cmd .= 'sudo service nginx restart';
        $this->fs->dumpFile($localPath . 'after.sh', $cmd);
    }

    /**
     * Create after.sh provisioning file
     */
    private function initAfterSh()
    {
        if ($this->fs->exists($this->basePath . '/after.sh')) {
            $this->fs->copy(__DIR__ . '/stubs/after.sh', $this->basePath . '/after.sh');
            $this->output->writeln('<comment>after.sh created in the root</comment>');
        }
    }

    /**
     * Create Homestead.yaml from the array
     *
     * @param string $path
     */
    private function dumpHomesteadFile($path)
    {
        $this->fs->dumpFile($path, Yaml::dump($this->config));
        $this->output->writeln('<comment>Homestead configuration updated</comment>');
    }
}
