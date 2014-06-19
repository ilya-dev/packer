<?php namespace Packer;

class PackerTest extends \TestCase {

    protected $packer;

    public function setUp()
    {
        $this->packer = new Packer;
    }

    /** @test */ function it_is_initializable()
    {
        $this->assertInstanceOf('Packer\Packer', $this->packer);
    }

} 