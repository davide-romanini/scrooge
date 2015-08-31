S.C.R.O.O.G.E.
==============

Exposes the [Inducks][1] database through a REST interface. 
This is *very alpha* stage. It could be useful for comic related programs (taggers, viewers...)
but also for semantic applications mashing up different sources.
Data is exported in JSON-LD using http://schema.org data model, with support for additional
classes defined in the (draft) comic extensions described here: 

  http://www.w3.org/community/schemabibex/wiki/Periodicals_and_Comics_synthesis

Examples:

 - [`/series/us/US`](http://scrooge-nkap.rhcloud.com/series/us/US) -> Uncle Scrooge series 
 - [`/series/us/US/issues`](http://scrooge-nkap.rhcloud.com/series/us/US/issues) -> All Uncle Scrooge issues
 - [`/series/us/US/issues/5`](http://scrooge-nkap.rhcloud.com/series/us/US/issues/5) -> Issue #5 for Uncle Scrooge (with contained story informations) 
 - `/series/?q=uncle+scrooge` -> Search series containing the terms uncle scrooge in the title
 - [`/stories/W+US++++5-02`]((http://scrooge-nkap.rhcloud.com/stories/W+US++++5-02 -> "The secret of Atlantis" Carl Barks story (with backlinks to issues printing it)
 - `/stories/?q=atlantis` -> Search stories containing the term atlantis in the title. Looks also for translated titles in related entries


Installation
------------

Any symfony2 supporting php server should be fine. The full inducks database must
be imported and converted to sqlite3:

```
 $ php app/console coa:import
```

Read the script comments for usage.

For full text indexing, run the inducks_fts.sql script after importing data.

TODO:
----

 - export character informations
 - general architecture cleanup
 - refine model mapping

Contribute:
----------

Try it, host it, fork it! If you have suggestions, open an issue!

Disclaimer:
----------

The data presented here is based on information from the freely available
[Inducks][1] database.


[1]:  http://inducks.org

