<?php

use Darkshare\Slugger;

// Encoding
it('can encode integers to incremental slugs')
    ->assertSame('Z', Slugger::encode(52));

it('can encode large numbers resulting in longer slugs')
    ->assertSame('fUcod', Slugger::encode(81259151));

it('starts at one when encoding')
    ->assertSame('a', Slugger::encode(1));

it('throws exception when encoding a value lower than one',
    fn () => Slugger::encode(-1)
)->throws(InvalidArgumentException::class);

// Decoding
it('can decode incremental slugs')
    ->assertSame(52, Slugger::decode('Z'));

it('can decode to a slug with multiple symbols')
    ->assertSame(81259151, Slugger::decode('fUcod'));

it('starts at one when decoding')
    ->assertSame(1, Slugger::decode('a'));
