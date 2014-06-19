<?php namespace Packer;

class PackerTest extends \PHPUnit_Framework_TestCase {

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