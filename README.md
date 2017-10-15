S.C.R.O.O.G.E.
==============

Exposes part of the [Inducks][1] database through a REST interface. 
It could be useful for comic related programs (taggers, viewers...)
but also for semantic applications mashing up different sources.
Data is exported in JSON-LD using http://bib.schema.org data model, specifically 
[ComicSeries](http://bib.schema.org/ComicSeries), [ComicStory](http://bib.schema.org/ComicStory) 
and related metadata.

Parts of the Comic Book Ontology (https://comicmeta.org/cbo/) and Dublin Core (http://purl.org/dc/elements/1.1/)
are also used.

Examples:

 - [`/series/us/US`](http://scrooge-nkap.rhcloud.com/series/us/US) -> Uncle Scrooge series 
 - [`/series/us/US/issues`](http://scrooge-nkap.rhcloud.com/series/us/US/issues) -> All Uncle Scrooge issues
 - [`/series/us/US/issues/5`](http://scrooge-nkap.rhcloud.com/series/us/US/issues/5) -> Issue #5 for Uncle Scrooge (with contained story informations) 
 - [`/series/?q=uncle+scrooge`](http://scrooge-nkap.rhcloud.com/series/?q=uncle+scrooge) -> Search series containing the terms uncle scrooge in the title
 - [`/stories/W+US++++5-02`](http://scrooge-nkap.rhcloud.com/stories/W+US++++5-02) -> "The secret of Atlantis" Carl Barks story (with backlinks to issues printing it)
 - [`/stories/?q=atlantis`](http://scrooge-nkap.rhcloud.com/stories/?q=atlantis) -> Search stories containing the term atlantis in the title. Looks also for translated titles in related entries

Install:
-------
To run the application locally (requires docker and docker-compose installed):

```
  ./make build
  ./make start
```

To update the local coa database:

```
  ./make update-local-db
```

Disclaimer:
----------

The data presented here is based on information from the freely available
[Inducks][1] database.


[1]:  https://inducks.org

