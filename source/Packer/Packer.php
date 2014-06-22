<?php namespace Packer;

use Symfony\Component\Console\Application;

class Packer {

    /**
     * The version of Packer.
     *
     * @var string
     */
    const VERSION = 'early-development';

    /**
     * Run Packer.
     *
     * @param boolean $testing
     * @return integer|Application
     */
    public function run($testing = false)
    {
        $application = new Application('Packer', Packer::VERSION);
        $application->add(new Commands\PackCommand);

        return $testing ? $application : $application->run();
    }

}
