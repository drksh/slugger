<?php
use JakobSteinn\Slugger\Slugger;

class SluggerTest extends PHPUnit_Framework_TestCase {


    /** @test */
    public function it_can_encode_incremental_slugs() {
        $slugger = new Slugger();

        $this->assertEquals('Q', $slugger->encode(42));
    }

    /** @test */
    public function it_can_decode_incremental_slugs() {
        $slugger = new Slugger();

        $this->assertEquals(42, $slugger->decode('Q'));
    }

}
