<?php namespace Packer\Commands;

use Symfony\Component\Console\Tester\CommandTester;

class PackCommandTest extends \TestCase
{
    protected $tester;

    protected $arguments = [
        '--destination' => 'packer.phar'
    ];

    protected function setUp()
    {
        parent::setUp();

        $this->tester = new CommandTester($this->subject);
        $this->tester->execute($this->arguments);
    }

    /** @test */ function it_receives_the_archive_name()
    {
        $output = $this->tester->getDisplay();

        $this->assertContains('The archive name you entered is packer.', $output);
        $this->assertNotContains('.phar', $output);
    }

    /** @test */ function it_guesses_the_path_to_the_binary()
    {
        $this->assertContains('The binary file you specified is binaries/packer.', $this->tester->getDisplay());
    }

    /** @test */ function it_adds_important_files_to_the_archive()
    {
        $this->assertContains('Files license, readme.md have been added to the archive.', $this->tester->getDisplay());
    }

    /** @test */ function it_adds_source_and_vendor_directories()
    {
        $this->assertContains('Directories source, vendor have been added to the archive.', $this->tester->getDisplay());
    }
}
