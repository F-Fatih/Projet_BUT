DROP TABLE IF EXISTS TitlePrincipals CASCADE;

CREATE TABLE TitlePrincipals(
	tconst text references TitleBasics,
	ordering int,
	nconst text references NameBasics,
	primary key(tconst, ordering, nconst),
	category text,
	job text,
	character text
);