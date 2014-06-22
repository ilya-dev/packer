<?php namespace Packer;

class PackerTest extends \TestCase {

    /** @test */ function it_is_initializable()
    {
        $this->assertInstanceOf('Packer\Packer', $this->subject);
    }

    /** @test */ function it_creates_a_new_application_instance()
    {
        $application = $this->subject->run(true);

        $this->assertInstanceOf('Symfony\Component\Console\Application', $application);
        $this->assertEquals('Packer', $application->getName());
        $this->assertNotEquals('UNKNOWN', $application->getVersion());
    }

}
