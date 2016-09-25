# A solid slugger

I've been looking for slugging libraries which are able to create incremental slugs, I couldn't find anything that satisfied my needs, therefore I had to have a go at it.

## Incremental slugs

These are best known for their sort nature in URL-shorteners. Let me give you an example of how they can work

Let's say you have your own little URL-shortener, and each of the user submitted URL's have an id. Since base-10 limits you very quickly, character-wise, you might want to show id `81259151` as `fUcod`.

## Usage
```php
$slugger = new \JakobSteinn\SolidSlugger\Slugger();

// encode id's
$slugger->short->encode(1); // a
$slugger->short->encode(81259151); // fUcod

// decode id's
$slugger->short->decode('a'); // 1
$slugger->short->decode('fUcod'); // 81259151
```

# To-Can-Maybe-Do:
- [ ] Config: Encode/decode starting from id 0 or 1
- [ ] Config: Make characters swappable
- [ ] Config: Character count offset
- [ ] Internal: Make slugger able to have multiple implementations
  - [ ] Short-style e.g. `gUcod`
  - [ ] Blog-style e.g. `thirteen-years-of-blogging`
