<?php namespace Packer\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PackCommand extends Command {

    /**
     * Instance of some class implementing the OutputInterface.
     *
     * @var OutputInterface
     */
    protected $output;

    /**
     * Configure the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('pack');
        $this->setDescription('Starts the builder');
        $this->addOption('destination', 'd', InputOption::VALUE_REQUIRED, 'The desired archive name.', null);
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
        $this->output = $output;

        if ( ! $archiveName = $input->getOption('destination'))
        {
            $archiveName = $this->askForArchiveName();
        }

        $output->writeln(sprintf('<info>The archive name you entered is %s.</info>', $archiveName));
    }

    /**
     * Ask the user for the desired archive name.
     *
     * @return string
     */
    protected function askForArchiveName()
    {
        /** @var Symfony\Component\Console\Helper\DialogHelper $dialog */
        $dialog = $this->getHelperSet()->get('dialog');
        $name = null;

        do
        {
            $name = $dialog->ask($this->output, '<question>Archive name?</question> ', null);
        }
        while (is_null($name));

        return $name;
    }

}