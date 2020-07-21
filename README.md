# A solid slugger

I've been looking for slugging libraries which are able to create incremental slugs, I couldn't find anything that satisfied my needs, therefore I had to have a go at it.

## Incremental slugs

These are best known for their sort nature in URL-shorteners. Let me give you an example of how they can work

Let's say you have your own little URL-shortener, and each of the user submitted URL's have an id. Since base-10 limits you very quickly, character-wise, you might want to show id `81259151` as `fUcod`.

## Usage
```php
// Transform ID's to slugs.
Darkshare\Slugger::encode(1); // a
Darkshare\Slugger::encode(81259151); // fUcod

// Transform slugs to IDs.
Darkshare\Slugger::decode('a'); // 1
Darkshare\Slugger::decode('fUcod'); // 81259151
```

