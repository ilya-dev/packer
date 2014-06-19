<?php namespace Packer;

use Symfony\Component\Console\Application;

class Packer {

    /**
     * Run Packer.
     *
     * @return integer
     */
    public function run()
    {
        return (new Application())->run();
    }

}
