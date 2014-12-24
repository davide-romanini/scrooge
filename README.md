S.C.R.O.O.G.E.
==============

Exposes the [Inducks][1] database through a REST interface. 
This is *very alpha* stage. It could be useful for comic related programs (taggers, viewers...)
but also for semantic applications mashing up different sources.
Data is exported in JSON-LD using http://schema.org data model, with support for additional
classes defined in the (draft) comic extensions described here: 

  http://www.w3.org/community/schemabibex/wiki/Periodicals_and_Comics_synthesis

Examples:

`/series/us/US` -> Uncle Scrooge series 
`/series/us/US/issues/5` -> Issue #5 for Uncle Scrooge (with contained story informations)
`/stories/W+US++++5-02 -> "The secret of Atlantis" Carl Barks story (with backlinks to issues printing it)

Installation
------------

Any symfony2 supporting php server should be fine. The full inducks database must
be imported and converted to sqlite3. You can use the script located here:

  https://gist.githubusercontent.com/davide-romanini/be55163e68c432e85c64/raw/0d217bfdda54a869c8ee603b67d20ebb8f9a96cd/inducks_unpack.sh

Read the script comments for usage.

TODO:
----

 - export author informations (penciler, inkers etc..)
 - export character informations
 - support full text searches for the various entities

Contribute:
----------

Try it, host it, fork it!

Disclaimer:
----------

The data presented here is based on information from the freely available
[Inducks][1] database.


[1]:  http://inducks.org

