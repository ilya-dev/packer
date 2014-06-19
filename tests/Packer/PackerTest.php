<?php namespace Packer;

class PackerTest extends \TestCase {

    /** @test */ function it_is_initializable()
    {
        $this->assertInstanceOf('Packer\Packer', $this->subject);
    }

}
