DROP TABLE IF EXISTS NameBasics CASCADE;

CREATE TABLE NameBasics(
	nconst text primary key,
	primaryName text not null,
	birthYear smallint check(birthYear>0),
	deathYear smallint, --check(deathYear is null OR deathYear>=birthYear),
	primaryProfession text[],
	knownForTitles text[]
);