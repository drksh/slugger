# A solid slugger

I've been looking for slugging libraries which are able to create both incremental slugs and normal blog-type slugs, with both an `encode` and `decode` option. It was nowhere to be found, so I created it.

## Incremental slugs

These are best known for their sort nature in URL-shorteners. Let me give you an example of how they can work

Let's say you have your own little URL-shortener, and each of the user submitted URL's have an id. Since base-10 limits you very quickly, character-wise, you might want to show id `81259151` as `gUcod`.

## Incremental slugs

When writing an app which needs human-readable slugs, it's important to be able to make sure it's configurable, and fits you exact needs.

The `blog`-slugger has various customization options. Do you want to squash stop words? Replace or remove accented letters? 

## Usage
```php
$slugger = new \JakobSteinn\SolidSlugger\Slugger();

// encode id's
$slugger->short->encode(1); // a
$slugger->short->encode(81259151); // gUcod

// decode id's
$slugger->short->decode('a'); // 1
$slugger->short->decode('gUcod'); // 81259151

// set default slugger
$slugger->setDefault($slugger->short);
$slugger->encode(1) // a
$slugger->setDefault($slugger->blog);
$slugger->encode("Thirteen Years Of Blogging") // thirteen-years-of-blogging

// add custom slugger
$slugger = \JakobSteinn\SolidSlugger\Slugger::usingCustomSlug(\Acme\UUIDSlugger::class)      ;
```

# Todo
- [ ] Config: Encode/decode starting from id 0 or 1
- [ ] Config: Make characters swappable
- [ ] Config: Character count offset
- [ ] Internal: Make slugger able to have multiple implementations
  - [ ] Short-style e.g. `gUcod`
  - [ ] Blog-style e.g. `thirteen-years-of-blogging`