<?php namespace Packer\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PackCommand extends Command {

    /**
     * Configure the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('pack');
        $this->setDescription('Starts the builder');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Hello, world!</info>');
    }

}
