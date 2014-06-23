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

}
