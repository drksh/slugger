# A solid slugger

I've been looking for slugging libraries which are able to create incremental slugs, I couldn't find anything that satisfied my needs, therefore I had to have a go at it.

## Incremental slugs

These are best known for their sort nature in URL-shorteners. Let me give you an example of how they can work

Let's say you have your own little URL-shortener, and each of the user submitted URL's have an id. Since base-10 limits you very quickly, character-wise, you might want to show id `81259151` as `fUcod`.

## Usage
```php
$slugger = new Darkshare\Slugger();

// encode id's
$slugger->encode(1); // a
$slugger->encode(81259151); // fUcod

// decode id's
$slugger->decode('a'); // 1
$slugger->decode('fUcod'); // 81259151
```

