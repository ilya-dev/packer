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

    /** @test */ function it_converts_the_object_into_proper_JSON()
    {
        $output = [
            'main' => 'binaries/packer',
            'output' => 'packer.phar',
            'stub' => true,
            'files' => ['license', 'readme.md'],
            'finder' => [
                [
                    'name' => '*.php',
                    'in' => 'source'
                ],
                [
                    'name' => '*.php',
                    'in' => 'vendor'
                ]
            ]
        ];

        $this->assertEquals($output, $this->subject->jsonSerialize());
    }

}