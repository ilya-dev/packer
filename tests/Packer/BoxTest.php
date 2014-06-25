<?php namespace Packer;

class BoxTest extends \TestCase {

    protected function setUp()
    {
        $this->subject = new Box('binaries/packer', 'packer', ['license', 'readme.md'], ['source', 'vendor']);
    }

    /** @test */ function it_is_initializable()
    {
        $this->assertInstanceOf('Packer\Box', $this->subject);
    }

    /** @test */ function it_is_json_serializable()
    {
        $this->assertTrue($this->subject instanceof \JsonSerializable);
    }

}