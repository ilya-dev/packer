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
     * @return integer
     */
    public function run()
    {
        $application = new Application('Packer', Packer::VERSION);
        $application->add(new Commands\PackCommand);

        return $application->run();
    }

}
