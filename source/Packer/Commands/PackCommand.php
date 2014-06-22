<?php namespace Packer\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PackCommand extends Command {

    /**
     * Instance of some class implementing the InputInterface.
     *
     * @var InputInterface
     */
    protected $input;

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
        $this->addOption('source', 's', InputOption::VALUE_REQUIRED, 'Path to the binary file.', null);
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
        $this->input = $input;
        $this->output = $output;

        $archiveName = $this->askForArchiveName();
        $binaryFile = $this->guessBinaryPath();

        $output->writeln(sprintf('<info>The archive name you entered is %s.</info>', $archiveName));
        $output->writeln(sprintf('<info>The binary file you specified is %s.</info>', $binaryFile));
    }

    /**
     * Ask the user for the desired archive name.
     *
     * @return string
     */
    protected function askForArchiveName()
    {
        if ( ! $name = $this->input->getOption('destination'))
        {
            $dialog = $this->getDialog();
            $name = null;

            do
            {
                $name = $dialog->ask($this->output, '<question>Archive name?</question> ', null);
            }
            while (is_null($name));
        }

        return str_ireplace('.phar', '', $name);
    }

    /**
     * Attempt to guess the path to the binary file.
     *
     * @return string
     */
    protected function guessBinaryPath()
    {
        if ($path = $this->input->getOption('source'))
        {
            return $path;
        }

        $dialog = $this->getDialog();
        $path = null;

        do
        {
            $path = $dialog->ask($this->output, '<question>Where is the binary file, yo?</question> ', null);
        }
        while (is_null($path));

        return $path;
    }

    /**
     * Get the Dialog helper instance.
     *
     * @return Symfony\Component\Console\Helper\DialogHelper
     */
    protected function getDialog()
    {
        return $this->getHelperSet()->get('dialog');
    }

}
