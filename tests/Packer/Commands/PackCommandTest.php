<?php namespace Packer\Commands;

use Symfony\Component\Console\Tester\CommandTester;

class PackCommandTest extends \TestCase
{
    /** @test */ function it_receives_the_archive_name()
    {
        $tester = new CommandTester($command = new PackCommand);
        $tester->execute([], ['destination' => 'packer']);

        $this->assertContains('The archive name you entered is packer.', $tester->getDisplay());
    }
}