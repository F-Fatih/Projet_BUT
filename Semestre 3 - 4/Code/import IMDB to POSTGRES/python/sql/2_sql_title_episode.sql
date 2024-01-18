DROP TABLE IF EXISTS TitleEpisode CASCADE;

CREATE TABLE TitleEpisode(
	tconst text primary key references TitleBasics,
	parentTconst text not null references TitleBasics,
	seasonNumber smallint check(seasonNumber>=0), 
	episodeNumber int check(episodeNumber>=0)
);