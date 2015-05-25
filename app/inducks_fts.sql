-- FTI for series (publications)

CREATE VIRTUAL TABLE publication_fts USING fts4(publicationcode, content);
CREATE VIRTUAL TABLE story_fts USING fts4(storycode, content);


insert into publication_fts(publicationcode, content) 
select publicationcode, title from inducks_publication;

-- FTI for stories, including translated titles for the same story

insert into story_fts(storycode, content) select storycode, title from inducks_story;
insert into story_fts (storycode, content) select s.storycode, e.title 
  from inducks_story s, inducks_entry e, inducks_storyversion sv 
 where e.storyversioncode=sv.storyversioncode and sv.storycode=s.storycode;

