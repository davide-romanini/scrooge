-- FTI for series (publications)
create virtual table publication_fts using fts4(publicationcode, content);
insert into publication_fts(publicationcode, content) 
select publicationcode, title from inducks_publication;

-- FTI for stories, including translated titles for the same story
create virtual table story_fts using fts4(storycode, content);
insert into story_fts(storycode, content) select storycode, title from inducks_story;
insert into story_fts (storycode, content) select s.storycode, e.title 
  from inducks_story s, inducks_entry e, inducks_storyversion sv 
 where e.storyversioncode=sv.storyversioncode and sv.storycode=s.storycode;

