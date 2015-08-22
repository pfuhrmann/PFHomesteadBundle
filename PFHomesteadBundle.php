<?php

namespace PF\HomesteadBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PFHomesteadBundle extends Bundle
{
    /**
     * Create new instance of PFHomesteadBundle
     */
    public function __construct()
    {
        $_ENV['HOME'] = getenv('HOME');
        $_ENV['VAGRANT_DOTFILE_PATH'] = $this->getHomesteadPath().DIRECTORY_SEPARATOR.'.vagrant';
    }

    /**
     * @return string
     */
    private function getHomesteadPath()
    {
        if (isset($_SERVER['HOME'])) {
            return $_SERVER['HOME'].'/.homestead';
        } else {
            return $_SERVER['HOMEDRIVE'].$_SERVER['HOMEPATH'].DIRECTORY_SEPARATOR.'.homestead';
        }
    }
}
