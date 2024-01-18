DROP TABLE IF EXISTS TitleRatings CASCADE;

CREATE TABLE TitleRatings(
	tconst text primary key references TitleBasics,
	averageRating float check(averageRating>=0 AND averageRating<=10),
	numVotes int check(numVotes>=0)
);