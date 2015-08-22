<?php

namespace PF\HomesteadBundle\Command;

use Symfony\Component\Console\Input\ArrayInput;

trait MakeTrait
{
    protected function execMake($output)
    {
        $command = $this->getApplication()->find('homestead:make');
        $command->run(new ArrayInput(['']), $output);
    }
}
