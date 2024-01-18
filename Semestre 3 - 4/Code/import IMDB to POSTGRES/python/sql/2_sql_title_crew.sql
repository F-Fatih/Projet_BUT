DROP TABLE IF EXISTS TitleCrew CASCADE;

CREATE TABLE TitleCrew(
	tconst text primary key references TitleBasics,
	directors text[],
	writers text[]
);