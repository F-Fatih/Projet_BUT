DROP TABLE IF EXISTS TitleAkas CASCADE;

CREATE TABLE TitleAkas(
	titleId text references TitleBasics,
	ordering int,
	PRIMARY KEY(titleId, ordering),
	title text not null, 
	region text,
	language text, 
	types text[], 
	attributes text[],
	isOriginalTitle boolean
);