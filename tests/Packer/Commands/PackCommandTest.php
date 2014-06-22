<?php namespace Packer\Commands;

use Symfony\Component\Console\Tester\CommandTester;

class PackCommandTest extends \TestCase
{
    /** @test */ function it_receives_the_archive_name()
    {
        $tester = new CommandTester(new PackCommand);
        $tester->execute(['--destination' => 'packer.phar']);

        $this->assertContains('The archive name you entered is packer.', $tester->getDisplay());
        $this->assertNotContains('.phar', $tester->getDisplay());
    }

    /** @test */ function it_guesses_the_path_to_the_binary()
    {
        $tester = new CommandTester(new PackCommand);
        $tester->execute(['--destination' => 'packer.phar', '--source' => 'bin/packer']);

        $this->assertContains('The binary file you specified is bin/packer.', $tester->getDisplay());
    }
}
