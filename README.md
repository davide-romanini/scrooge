S.C.R.O.O.G.E.
==============

Exposes the [Inducks][1] database through a REST interface. 
This is *very alpha* stage. It could be useful for comic related programs (taggers, viewers...)
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
 - [`/stories/?q=atlantis`](http://scrooge-nkap.rhcloud.com/stories/?q=uncle+scrooge) -> Search stories containing the term atlantis in the title. Looks also for translated titles in related entries


Installation
------------

Any symfony2 supporting php server should be fine. The full inducks database must
be imported. There's a cron job in `.openshift/cron/daily/updatedb.sh` wrote specifically
to be executed inside an openshift environment. It should be easy to change for local
mysql deployment.

Some notes:
 - this mysql configuration is required: `lower_case_table_names=1`
   On openshift you must set with `rhc env set OPENSHIFT_MYSQL_LOWER_CASE_TABLE_NAMES=1 -a <app> && rhc cartridge restart -c mysql-5.5 -a <app>`
 - you must create a database named `coa` and it must be in UTF8. You can change it with:
   `ALTER DATABASE databasename CHARACTER SET utf8 COLLATE utf8_unicode_ci;`

Contribute:
----------

Try it, host it, fork it! If you have suggestions, open an issue!

Disclaimer:
----------

The data presented here is based on information from the freely available
[Inducks][1] database.


[1]:  http://inducks.org

