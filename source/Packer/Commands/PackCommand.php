<?php namespace Packer\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Finder\Finder;

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
        $this->addOption('files', 'f', InputOption::VALUE_REQUIRED, 'Files you would like to include.', null);
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
        $binaryFile = $this->guessBinaryPath($archiveName);
        $files = $this->addFiles();

        $output->writeln(sprintf('<info>The archive name you entered is %s.</info>', $archiveName));
        $output->writeln(sprintf('<info>The binary file you specified is %s.</info>', $binaryFile));
        $output->writeln(sprintf('<info>Files %s have been added to the archive.</info>', implode(', ', $files)));
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
     * @param string $archiveName
     * @return string
     */
    protected function guessBinaryPath($archiveName)
    {
        if ($path = $this->input->getOption('source'))
        {
            return $path;
        }

        $directories = ['bin', 'bins', 'binary', 'binaries'];

        foreach ($directories as $directory)
        {
            $path = sprintf('%s/%s/%s', getcwd(), $directory, $archiveName);

            if (file_exists($path))
            {
                return "{$directory}/{$archiveName}";
            }
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
     * Add (license, readme etc.) files to the archive.
     *
     * @return array
     */
    protected function addFiles()
    {
        if ($files = $this->input->getOption('files'))
        {
            return array_map('trim', explode(',', $files));
        }

        $finder = new Finder;
        $finder->files()->in(getcwd());

        $files = [];

        foreach ($finder as $file)
        {
            if (in_array($file->getFilename(), ['license', 'readme.md']))
            {
                $files[] = $file->getFilename();
            }
        }

        return $files;
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
