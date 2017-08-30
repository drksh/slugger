<?php

use Darkshare\Slugger;

class SluggerTest extends PHPUnit_Framework_TestCase {

    /**
     * The Slugger instance under test.
     *
     * @var Darkshare\Slugger
     */
    protected $slugger;

    /**
     * Setup current test case.
     */
    protected function setUp()
    {
        $this->slugger = new Slugger();
    }

    /** @test */
    public function it_can_encode_incremental_slugs()
    {
        $this->assertEquals('Z', $this->slugger->encode(52));
    }

    /** @test */
    public function it_can_encode_to_a_slug_with_multiple_symbols()
    {
        $this->assertEquals('fUcod', $this->slugger->encode(81259151));
    }

    /** @test */
    public function it_starts_at_one_when_encoding()
    {
        $this->assertEquals('a', $this->slugger->encode(1));
    }

    /** @test */
    public function it_throws_exception_if_encoding_a_value_less_than_one()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->slugger->encode(-1);
    }

    /** @test */
    public function it_can_decode_incremental_slugs()
    {
        $this->assertEquals(52, $this->slugger->decode('Z'));
    }

    /** @test */
    public function it_can_dncode_to_a_slug_with_multiple_symbols()
    {
        $this->assertEquals(81259151, $this->slugger->decode('fUcod'));
    }

    /** @test */
    public function it_starts_at_one_when_decoding()
    {
        $this->assertEquals(1, $this->slugger->decode('a'));
    }
}
