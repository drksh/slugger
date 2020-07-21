<?php

/**
 * The Slugger instance under test.
 *
 * @var Darkshare\Slugger
 */
$slugger = new Darkshare\Slugger();

it('can encode integers to incremental slugs')
    ->assertSame('Z', $slugger->encode(52));

it('can encode large numbers resulting in longer slugs')
    ->assertEquals('fUcod', $slugger->encode(81259151));

it('starts at one when encoding')
    ->assertEquals('a', $slugger->encode(1));

it('throws exception when encoding a value lower than one',
    fn () => $slugger->encode(-1)
)->throws(InvalidArgumentException::class);

it('can decode incremental slugs')
    ->assertEquals(52, $slugger->decode('Z'));

it('can decode to a slug with multiple symbols')
    ->assertEquals(81259151, $slugger->decode('fUcod'));

it('starts at one when decoding')
    ->assertEquals(1, $slugger->decode('a'));
