-- based on http://coa.inducks.org/inducks/isv/createtables.sql
-- TODO: FTI not implemented
CREATE TABLE inducks_storyversion (
    storyversioncode varchar(19),
    storycode varchar(19),
    entirepages int(7),
    brokenpagenumerator int(7),
    brokenpagedenominator int(7),
    brokenpageunspecified CHAR(1) CHECK(brokenpageunspecified IN ('Y','N')),
    kind varchar(1),
    rowsperpage int(7),
    columnsperpage int(7),
    appisxapp CHAR(1) CHECK(appisxapp IN ('Y','N')),
    what varchar(1),
    appsummary text,
    plotsummary text,
    writsummary text,
    artsummary text,
    inksummary text,
    creatorrefsummary text,
    keywordsummary text,
    estimatedpanels int(7)
);
CREATE INDEX idx_storyversion_pk0 ON inducks_storyversion(storyversioncode);
CREATE INDEX idx_storyversion_fk1 ON inducks_storyversion(storycode);

CREATE TABLE inducks_herocharacter (
    storycode varchar(18),
    charactercode varchar(54),
    number int(7)
);
CREATE INDEX idx_herocharacter_pk0 ON inducks_herocharacter(storycode, charactercode);
CREATE INDEX idx_herocharacter_fk0 ON inducks_herocharacter(charactercode);


CREATE TABLE inducks_appearance (
    storyversioncode varchar(19),
    charactercode varchar(62),
    number int(7),
    appearancecomment varchar(209)
);
CREATE INDEX idx_appearance_pk0 ON inducks_appearance(storyversioncode, charactercode);
CREATE INDEX idx_appearance_fk0 ON inducks_appearance(charactercode);


CREATE TABLE inducks_storyjob (
    storyversioncode varchar(19),
    personcode varchar(79),
    plotwritartink varchar(1),
    storyjobcomment varchar(141),
    indirect CHAR(1) CHECK(indirect IN ('Y','N'))
);
CREATE INDEX idx_storyjob_pk0 ON inducks_storyjob(storyversioncode, personcode, plotwritartink);
CREATE INDEX idx_storyjob_fk0 ON inducks_storyjob(personcode);

CREATE TABLE inducks_story (
    storycode varchar(19),
    originalstoryversioncode varchar(19),
    creationdate varchar(21),
    firstpublicationdate varchar(10),
    endpublicationdate varchar(10),
    title text,
    usedifferentcode varchar(19),
    storycomment varchar(664),
    error CHAR(1) CHECK(error IN ('Y','N')),
    repcountrysummary text,
    storyparts int(7),
    locked CHAR(1) cHECK(locked IN ('Y','N')),
    inputfilecode int(7),
    issuecodeofstoryitem varchar(14)
);
CREATE INDEX idx_story_pk0 ON inducks_story(storycode);
CREATE INDEX idx_story_fk0 ON inducks_story(originalstoryversioncode);
CREATE INDEX idx_story_fk1 ON inducks_story(firstpublicationdate);

CREATE TABLE inducks_substory (
    storycode varchar(12),
    originalstoryversioncode varchar(12),
    superstorycode varchar(13),
    part varchar(3),
    firstpublicationdate varchar(10),
    title varchar(76),
    substorycomment varchar(349),
    error CHAR(1) CHECK(error IN ('Y','N')),
    locked CHAR(1) CHECK(locked IN ('Y','N')),
    inputfilecode int(7)
);
CREATE INDEX idx_substory_pk0 ON inducks_substory(storycode);
CREATE INDEX idx_substory_fk0 ON inducks_substory(firstpublicationdate);

CREATE TABLE induckspriv_story (
    storycode varchar(17),
    storycomment varchar(1275)
);
CREATE INDEX idx_privstory_pk0 ON induckspriv_story(storycode);

CREATE TABLE inducks_storysubseries (
    storycode varchar(16),
    subseriescode varchar(144),
    storysubseriescomment varchar(23)
);

CREATE INDEX idx_storysubseries_pk0 ON inducks_storysubseries(storycode, subseriescode);
CREATE INDEX idx_storysubseries_fk0 ON inducks_storysubseries(subseriescode);
--LOAD DATA LOCAL INFILE "./isv/inducks_storysubseries.isv" INTO TABLE inducks_storysubseries_temp FIELDS TERMINATED BY '^' IGNORE 1 LINES;

CREATE TABLE inducks_storycodes (
    storycode varchar(19),
    alternativecode varchar(72),
    unpackedcode varchar(82),
    codecomment varchar(34)
);
CREATE INDEX idx_storycodes_pk0 ON inducks_storycodes(storycode, alternativecode);
CREATE INDEX idx_storycodes_fk0 ON inducks_storycodes(alternativecode);

CREATE TABLE inducks_storydescription (
    storyversioncode varchar(19),
    languagecode varchar(7),
    desctext varchar(2814)
);
CREATE INDEX idx_storydescription_pk0 ON inducks_storydescription(storyversioncode, languagecode);
CREATE INDEX idx_storydescription_fk0 ON inducks_storydescription(languagecode);

CREATE TABLE inducks_storyreference (
    fromstorycode varchar(23),
    tostorycode varchar(17),
    referencereasonid int(7)
);

CREATE INDEX idx_storyreference_pk0 ON inducks_storyreference(fromstorycode, tostorycode);
CREATE INDEX idx_storyreference_fk0 ON inducks_storyreference(tostorycode);
CREATE INDEX idx_storyreference_fk1 ON inducks_storyreference(referencereasonid);

CREATE TABLE inducks_movie (
    moviecode varchar(14),
    title varchar(62),
    moviecomment varchar(570),
    appsummary text,
    moviejobsummary text,
    locked CHAR(1) CHECK(locked IN ('Y','N')),
    inputfilecode int(7),
    aka varchar(81),
    creationdate varchar(10),
    moviedescription varchar(836),
    distributor varchar(50),
    genre varchar(3),
    orderer varchar(178),
    publicationdate varchar(10),
    source varchar(91),
    tim varchar(6)
);
CREATE INDEX idx_movie_pk0 ON inducks_movie(moviecode);

CREATE TABLE inducks_moviejob (
    moviecode varchar(14),
    personcode varchar(39),
    role varchar(15),
    moviejobcomment varchar(82),
    indirect CHAR(1) CHECK(indirect IN ('Y','N'))
);
CREATE INDEX idx_moviejob_pk0 ON inducks_moviejob(moviecode, personcode, role);
CREATE INDEX idx_moviejob_fk0 ON inducks_moviejob(personcode);

CREATE TABLE inducks_moviereference (
    storycode varchar(17),
    moviecode varchar(14),
    referencereasonid int(7),
    frommovietostory CHAR(1) CHECK(frommovietostory IN ('Y','N'))
);
CREATE INDEX idx_moviereference_pk0 ON inducks_moviereference(storycode, moviecode);
CREATE INDEX idx_moviereference_fk0 ON inducks_moviereference(moviecode);
CREATE INDEX idx_moviereference_fk1 ON inducks_moviereference(referencereasonid);

CREATE TABLE inducks_moviecharacter (
    moviecode varchar(13),
    charactercode varchar(35),
    istitlecharacter CHAR(1) CHECK(istitlecharacter IN ('Y','N'))
);
CREATE INDEX idx_moviecharacter_pk0 ON inducks_moviecharacter(moviecode, charactercode);
CREATE INDEX idx_moviecharacter_fk0 ON inducks_moviecharacter(charactercode);

CREATE TABLE inducks_entry (
    entrycode varchar(22),
    issuecode varchar(17),
    storyversioncode varchar(19),
    languagecode varchar(7),
    includedinentrycode varchar(18),
    position varchar(10),
    printedcode varchar(88),
    guessedcode varchar(39),
    title varchar(235),
    reallytitle CHAR(1) CHECK(reallytitle IN ('Y','N')),
    printedhero varchar(96),
    changes varchar(596),
    cut varchar(100),
    minorchanges varchar(558),
    missingpanels varchar(2),
    mirrored CHAR(1) CHECK(mirrored IN ('Y','N')),
    sideways CHAR(1) CHECK(sideways IN ('Y','N')),
    startdate varchar(10),
    enddate varchar(10),
    identificationuncertain CHAR(1) CHECK(identificationuncertain IN ('Y','N')),
    alsoreprint varchar(66),
    part varchar(5),
    entrycomment varchar(3476),
    error CHAR(1) CHECK(error IN ('Y','N'))
);
CREATE INDEX idx_entry_pk0 ON inducks_entry(entrycode);
CREATE INDEX idx_entry_fk0 ON inducks_entry(issuecode);
CREATE INDEX idx_entry_fk1 ON inducks_entry(storyversioncode);
CREATE INDEX idx_entry_fk2 ON inducks_entry(languagecode);
CREATE INDEX idx_entry_fk3 ON inducks_entry(includedinentrycode);
CREATE INDEX idx_entry_fk4 ON inducks_entry(position);

CREATE TABLE induckspriv_entry (
    entrycode varchar(22),
    entrycomment varchar(1209)
);
CREATE INDEX idx_priventry_pk0 ON induckspriv_entry(entrycode);

CREATE TABLE inducks_logocharacter (
    entrycode varchar(22),
    charactercode varchar(54),
    reallyintitle CHAR(1) CHECK(reallyintitle IN ('Y','N')),
    number int(7),
    logocharactercomment varchar(28)
);
CREATE INDEX idx_logocharacter_pk0 ON inducks_logocharacter(entrycode, charactercode);
CREATE INDEX idx_logocharacter_fk0 ON inducks_logocharacter(charactercode);


CREATE TABLE inducks_entrycharactername (
    entrycode varchar(22),
    charactercode varchar(55),
    charactername varchar(72)
);
CREATE INDEX idx_entrycharactername_pk0 ON inducks_entrycharactername(entrycode, charactercode);
CREATE INDEX idx_entrycharactername_fk0 ON inducks_entrycharactername(charactercode);

CREATE TABLE inducks_entryjob (
    entrycode varchar(18),
    personcode varchar(50),
    transletcol varchar(1),
    entryjobcomment varchar(51)
);
CREATE INDEX idx_entryjob_pk0 ON inducks_entryjob(entrycode, personcode, transletcol);
CREATE INDEX idx_entryjob_fk0 ON inducks_entryjob(personcode);

CREATE TABLE inducks_language (
    languagecode varchar(7),
    defaultlanguagecode varchar(5),
    languagename varchar(20)
);
CREATE INDEX idx_language_pk0 ON inducks_language(languagecode);
CREATE INDEX idx_language_fk0 ON inducks_language(defaultlanguagecode);


CREATE TABLE inducks_languagename (
    desclanguagecode varchar(5),
    languagecode varchar(7),
    languagename varchar(57)
);
CREATE INDEX idx_languagename_pk0 ON inducks_languagename(desclanguagecode, languagecode);
CREATE INDEX idx_languagename_fk0 ON inducks_languagename(languagecode);


CREATE TABLE inducks_countryname(
    countrycode varchar(2),
    languagecode varchar(5),
    countryname varchar(88)
);
CREATE INDEX idx_countryname_pk0 ON inducks_countryname(countrycode, languagecode);
CREATE INDEX idx_countryname_fk0 ON inducks_countryname(languagecode);

CREATE TABLE inducks_country (
    countrycode varchar(2),
    countryname varchar(20),
    defaultlanguage varchar(7)
);
CREATE INDEX idx_country_pk0 ON inducks_country(countrycode);

CREATE TABLE inducks_inputfile (
    inputfilecode int(7),
    path varchar(11),
    filename varchar(22),
    layout varchar(10),
    locked CHAR(1) CHECK (locked IN ('Y','N')),
    countrycode varchar(2),
    languagecode varchar(7),
    producercode varchar(15)
);
CREATE INDEX idx_inputfile_pk0 ON inducks_inputfile(inputfilecode);

CREATE TABLE inducks_log (
    number int(7),
    logkey varchar(45),
    storycode varchar(39),
    logid varchar(4),
    logtype varchar(1),
    par1 varchar(2070),
    par2 varchar(1846),
    par3 varchar(364),
    marked CHAR(1) CHECK(marked IN ('Y','N')),
    inputfilecode int(7)
);
CREATE INDEX idx_log_pk0 ON inducks_log(number);

CREATE TABLE inducks_logincharge(
    lognumber int(7),
    personcode varchar(3)
);
CREATE INDEX idx_logincharge_pk0 ON inducks_logincharge(lognumber, personcode);

CREATE TABLE inducks_logdata(
    logid varchar(4),
    category int(7),
    logtext varchar(108)
);
CREATE INDEX idx_logdata_pk0 ON inducks_logdata(logid);

CREATE TABLE inducks_issue (
    issuecode varchar(17),
    issuerangecode varchar(13),
    publicationcode varchar(12),
    issuenumber varchar(12),
    title varchar(158),
    size varchar(61),
    pages varchar(82),
    price varchar(91),
    printrun varchar(142),
    attached varchar(288),
    oldestdate varchar(10),
    fullyindexed CHAR(1) CHECK (fullyindexed IN ('Y','N')),
    issuecomment varchar(1270),
    error CHAR(1) CHECK(error IN ('Y','N')),
    filledoldestdate varchar(10),
    locked CHAR(1) CHECK(locked IN ('Y','N')),
    inxforbidden CHAR(1) CHECK(inxforbidden IN ('Y','N')),
    inputfilecode int(7)
);
CREATE INDEX idx_issue_pk0 ON inducks_issue(issuecode);
CREATE INDEX idx_issue_fk0 ON inducks_issue(issuerangecode);
CREATE INDEX idx_issue_fk1 ON inducks_issue(publicationcode);

CREATE TABLE inducks_issuejob (
    issuecode varchar(17),
    personcode varchar(48),
    inxtransletcol varchar(1),
    issuejobcomment varchar(32)
);
CREATE INDEX idx_issuejob_pk0 ON inducks_issuejob(issuecode, personcode, inxtransletcol);
CREATE INDEX idx_issuejob_fk0 ON inducks_issuejob(personcode);

CREATE TABLE inducks_issuedate(
    issuecode varchar(17),
    date varchar(10),
    kindofdate varchar(76)
);
CREATE INDEX idx_issuedate_pk0 ON inducks_issuedate(issuecode, date);

CREATE TABLE inducks_issuecollecting (
    collectingissuecode varchar(17),
    collectedissuecode varchar(21)
);
CREATE INDEX idx_issuecollecting_pk0 ON inducks_issuecollecting(collectingissuecode, collectedissuecode);
CREATE INDEX idx_issuecollecting_fk0 ON inducks_issuecollecting(collectedissuecode);

CREATE TABLE inducks_equiv(
    issuecode varchar(76),
    equivid int(7),
    equivcomment varchar(2)
);
CREATE INDEX idx_equiv_pk0 ON inducks_equiv(issuecode, equivid);
CREATE INDEX idx_equiv_fk0 ON inducks_equiv(equivid);

CREATE TABLE inducks_issuerange(
    issuerangecode varchar(13),
    publicationcode varchar(9),
    title varchar(229),
    circulation varchar(6),
    issuerangecomment varchar(468),
    numbersarefake CHAR(1) CHECK (numbersarefake IN ('Y','N')),
    error CHAR(1) CHECK(error IN ('Y','N'))
);
CREATE INDEX idx_issuerange_pk0 ON inducks_issuerange(issuerangecode);
CREATE INDEX idx_issuerange_fk0 ON inducks_issuerange(publicationcode);

CREATE TABLE inducks_publication (
    publicationcode varchar(12),
    countrycode varchar(2),
    languagecode varchar(7),
    title text,
    size varchar(61),
    publicationcomment varchar(1298),
    circulation varchar(4),
    numbersarefake CHAR(1) CHECK(numbersarefake IN ('Y','N')),
    error CHAR(1) CHECK(error IN ('Y','N')),
    locked CHAR(1) CHECK(locked IN ('Y','N')),
    inxforbidden CHAR(1) CHECK(inxforbidden IN ('Y','N')),
    inputfilecode int(7)
);
CREATE INDEX idx_publication_pk0 ON inducks_publication(publicationcode);
CREATE INDEX idx_publication_fk0 ON inducks_publication(countrycode);
CREATE INDEX idx_publication_fk1 ON inducks_publication(languagecode);

CREATE TABLE inducks_publicationjob (
    publicationcode varchar(12),
    personcode varchar(3),
    incharge varchar(1),
    publicationjobcomment varchar(1)
);
CREATE INDEX idx_publicationjob_pk0 ON inducks_publicationjob(publicationcode, personcode, incharge);
CREATE INDEX idx_publicationjob_fk0 ON inducks_publicationjob(personcode);

CREATE TABLE inducks_publicationcategory (
    publicationcode varchar(12),
    category varchar(61)
);
CREATE INDEX idx_publicationcategory_pk0 ON inducks_publicationcategory(publicationcode);

CREATE TABLE inducks_publicationname (
    publicationcode varchar(9),
    publicationname varchar(62)
);
CREATE INDEX idx_publicationname_pk0 ON inducks_publicationname(publicationcode);

CREATE TABLE inducks_publisher(
    publisherid varchar(84),
    publishername text
);
CREATE INDEX idx_publisher_pk0 ON inducks_publisher(publisherid);

CREATE TABLE inducks_publishingjob(
    publisherid varchar(84),
    issuecode varchar(17),
    publishingjobcomment varchar(36)
);
CREATE INDEX idx_publishingjob_pk0 ON inducks_publishingjob(publisherid, issuecode);
CREATE INDEX idx_publishingjob_fk0 ON inducks_publishingjob(issuecode);


CREATE TABLE inducks_character (
    charactercode varchar(69),
    charactername text,
    official CHAR(1) CHECK(official IN ('Y','N')),
    onetime CHAR(1) CHECK(onetime IN ('Y','N')),
    heroonly CHAR(1) CHECK(heroonly IN ('Y','N')),
    charactercomment varchar(567)
);
CREATE INDEX idx_character_pk0 ON inducks_character(charactercode);

CREATE TABLE inducks_charactername (
    charactercode varchar(38),
    languagecode varchar(7),
    charactername varchar(83),
    preferred CHAR(1) CHECK(preferred IN ('Y','N')),
    characternamecomment varchar(99)
);
CREATE INDEX idx_charactername_pk0 ON inducks_charactername(charactercode, languagecode, charactername);
CREATE INDEX idx_charactername_fk0 ON inducks_charactername(languagecode);

CREATE TABLE inducks_characteralias (
    charactercode varchar(30),
    charactername varchar(58)
);
CREATE INDEX idx_characteralias_pk0 ON inducks_characteralias(charactername);
CREATE INDEX idx_characteralias_fk0 ON inducks_characteralias(charactercode);

CREATE TABLE inducks_characterreference (
    fromcharactercode varchar(19),
    tocharactercode varchar(19),
    isgroupofcharacters CHAR(1) CHECK(isgroupofcharacters IN ('Y','N'))
);
CREATE INDEX idx_characterreference_pk0 ON inducks_characterreference(fromcharactercode, tocharactercode);
CREATE INDEX idx_characterreference_fk0 ON inducks_characterreference(tocharactercode);

CREATE TABLE inducks_characterdetail (
    charactername varchar(7),
    charactercode varchar(6),
    number int(7)
);
CREATE INDEX idx_characterdetail_pk0 ON inducks_characterdetail(charactercode);
CREATE INDEX idx_characterdetail_fk0 ON inducks_characterdetail(charactername);

CREATE TABLE inducks_subseries (
    subseriescode varchar(95),
    subseriesname varchar(95),
    official CHAR(1) CHECK(official IN ('Y','N')),
    important CHAR(1) CHECK(important IN ('Y','N')),
    subseriescomment varchar(97),
    subseriescategory varchar(1)
);
CREATE INDEX idx_subseries ON inducks_subseries(subseriescode);

CREATE TABLE inducks_subseriesname(
    subseriescode varchar(42),
    languagecode varchar(7),
    subseriesname varchar(121)
);
CREATE INDEX idx_subseriesname_pk0 ON inducks_subseriesname(subseriescode, languagecode);
CREATE INDEX idx_subseriesname_fk0 ON inducks_subseriesname(languagecode);

CREATE TABLE inducks_referencereason(
    referencereasonid int(7),
    referencereasontext varchar(87)
);
CREATE INDEX idx_referencereason_pk0 ON inducks_referencereason(referencereasonid);

CREATE TABLE inducks_referencereasonname (
    referencereasonid int(7),
    languagecode varchar(2),
    referencereasontranslation varchar(28)
);
CREATE INDEX idx_referencereasonname_pk0 ON inducks_referencereasonname(referencereasonid, languagecode);
CREATE INDEX idx_referencereasonname_fk0 ON inducks_referencereasonname(languagecode);

CREATE TABLE inducks_universe (
    universecode varchar(28),
    universecomment varchar(1)
);
CREATE INDEX idx_universe_pk0 ON inducks_universe (universecode);


CREATE TABLE inducks_ucrelation (
    universecode varchar(28),
    charactercode varchar(38)
);
CREATE INDEX idx_ucrelation_pk0 ON inducks_ucrelation(universecode, charactercode);
CREATE INDEX idx_ucrelation_fk0 ON inducks_ucrelation(charactercode);

CREATE TABLE inducks_universename (
    universecode varchar(28),
    languagecode varchar(5),
    universename varchar(76)
);
CREATE INDEX idx_universename_pk0 ON inducks_universename(universecode, languagecode);
CREATE INDEX idx_universename_fk0 ON inducks_universename(languagecode);

CREATE TABLE inducks_person (
    personcode varchar(79),
    nationalitycountrycode varchar(2),
    fullname text,
    official CHAR(1) CHECK(official IN ('Y','N')),
    personcomment varchar(221),
    unknownstudiomember CHAR(1) CHECK(unknownstudiomember IN ('Y','N')),
    isfake CHAR(1) CHECK(isfake IN ('Y','N')),
    birthname text,
    borndate varchar(10),
    bornplace varchar(30),
    deceaseddate varchar(10),
    deceasedplace varchar(31),
    education varchar(189),
    moviestext varchar(879),
    comicstext varchar(1327),
    othertext varchar(307),
    photofilename varchar(32),
    photocomment varchar(68),
    photosource varchar(67),
    personrefs varchar(180)
);
CREATE INDEX idx_person_pk0 ON inducks_person(personcode);
CREATE INDEX idx_person_fk0 ON inducks_person(nationalitycountrycode);

CREATE TABLE inducks_personalias(
    personcode varchar(31),
    surname varchar(48),
    givenname varchar(31),
    official CHAR(1) CHECK(official IN ('Y','N'))
);
CREATE INDEX idx_personalias_fk0 ON inducks_personalias(personcode);

CREATE TABLE inducks_studio(
    studiocode varchar(23),
    countrycode varchar(2),
    studioname varchar(24),
    city varchar(12),
    description varchar(415),
    othertext varchar(94),
    photofilename varchar(18),
    photocomment varchar(40),
    photosource varchar(42),
    studiorefs varchar(204)
);
CREATE INDEX idx_studio_pk0 ON inducks_studio(studiocode);
CREATE INDEX idx_studio_fk0 ON inducks_studio(countrycode);

CREATE TABLE inducks_studiowork (
    studiocode varchar(23),
    personcode varchar(24)
);
CREATE INDEX idx_studiowork_pk0 ON inducks_studiowork(studiocode, personcode);
CREATE INDEX idx_studiowork_fk0 ON inducks_studiowork(personcode);

CREATE TABLE inducks_site (
    sitecode varchar(16),
    urlbase varchar(51),
    images CHAR(1) CHECK(images IN ('Y','N')),
    sitename varchar(85),
    sitelogo varchar(85),
    properties varchar(1)
);
CREATE INDEX idx_site_pk0 ON inducks_site(sitecode);

CREATE TABLE inducks_entryurl(
    entrycode varchar(21),
    sitecode varchar(11),
    pagenumber int(7),
    url varchar(87)
);
CREATE INDEX idx_entryurl_fk0 ON inducks_entryurl(entrycode);
CREATE INDEX idx_entryurl_fk1 ON inducks_entryurl(sitecode);
CREATE INDEX idx_entryurl_fk2 ON inducks_entryurl(url);

CREATE TABLE induckspriv_entryurl (
    entrycode varchar(18),
    sitecode varchar(11),
    pagenumber int(7),
    url varchar(46)
);
CREATE INDEX idx_priventryurl_fk0 ON induckspriv_entryurl(entrycode);
CREATE INDEX idx_priventryurl_fk1 ON induckspriv_entryurl(sitecode);
CREATE INDEX idx_priventryurl_fk2 ON induckspriv_entryurl(url);

CREATE TABLE inducks_publicationurl(
    publicationcode varchar(10),
    sitecode varchar(16),
    url varchar(236)
);
CREATE INDEX idx_publicationurl_pk0 ON inducks_publicationurl(publicationcode, sitecode);
CREATE INDEX idx_publicationurl_fk0 ON inducks_publicationurl(sitecode);

CREATE TABLE inducks_issueurl(
    issuecode varchar(14),
    sitecode varchar(12),
    url varchar(12)
);
CREATE INDEX idx_issueurl_pk0 ON inducks_issueurl(issuecode, sitecode);
CREATE INDEX idx_issueurl_fk0 ON inducks_issueurl(sitecode);

CREATE TABLE inducks_personurl(
    personcode varchar(24),
    sitecode varchar(15),
    url varchar(31)
);
CREATE INDEX idx_personurl_pk0 ON inducks_personurl(personcode, sitecode);
CREATE INDEX idx_personurl_fk0 ON inducks_personurl(sitecode);

CREATE TABLE inducks_characterurl(
    charactercode varchar(18),
    sitecode varchar(11),
    url varchar(13)
);
CREATE INDEX idx_characterurl_pk0 ON inducks_characterurl(charactercode, sitecode);
CREATE INDEX idx_characterurl_fk0 ON inducks_characterurl(sitecode);

CREATE TABLE inducks_storyurl(
    storycode varchar(13),
    sitecode varchar(15),
    url varchar(40)
);
CREATE INDEX idx_storyurl_pk0 ON inducks_storyurl(storycode, sitecode);
CREATE INDEX idx_storyurl_fk0 ON inducks_storyurl(sitecode);

CREATE TABLE inducks_storyheader (
    storyheadercode varchar(9),
    level varchar(1),
    title varchar(217),
    storyheadercomment varchar(544)
);
CREATE INDEX idx_storyheader_pk0 ON inducks_storyheader(storyheadercode);

CREATE TABLE inducks_statpersonstory(
    personcode varchar(79),
    productionletter varchar(1),
    total int(7),
    yearrange varchar(54)
);
CREATE INDEX idx_statpersonstory_pk0 ON inducks_statpersonstory(personcode, productionletter);

CREATE TABLE inducks_statpersoncountry(
    personcode varchar(79),
    countrycode varchar(2),
    total int(7)
);
CREATE INDEX idx_statpersoncountry_pk0 ON inducks_statpersoncountry(personcode, countrycode);

CREATE TABLE inducks_statpersonperson (
    personcode varchar(79),
    copersoncode varchar(79),
    total int(7),
    yearrange varchar(59)
);
CREATE INDEX idx_statpersonperson_pk0 ON inducks_statpersonperson(personcode, total);

CREATE TABLE inducks_statpersoncharacter (
    personcode varchar(79),
    charactercode varchar(58),
    total int(7),
    yearrange varchar(101)
);
CREATE INDEX idx_statpersoncharacter_pk0 ON inducks_statpersoncharacter(personcode, total);

CREATE TABLE inducks_statcharacterstory(
    charactercode varchar(58),
    productionletter varchar(1),
    total int(7),
    yearrange varchar(92)
);
CREATE INDEX idx_statcharacterstory_pk0 ON inducks_statcharacterstory(charactercode, productionletter);

CREATE TABLE inducks_statcharactercountry(
    charactercode varchar(58),
    countrycode varchar(2),
    total int(7)
);
CREATE INDEX idx_statcharactercountry_pk0 ON inducks_statcharactercountry(charactercode, countrycode);

CREATE TABLE inducks_statcharactercharacter (
    charactercode varchar(58),
    cocharactercode varchar(58),
    total int(7),
    yearrange varchar(136)
);
CREATE INDEX idx_statcharactercharacter_pk0 ON inducks_statcharactercharacter(charactercode, total);
