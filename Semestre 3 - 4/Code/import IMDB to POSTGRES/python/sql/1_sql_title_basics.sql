DROP TABLE IF EXISTS TitleBasics CASCADE;

CREATE TABLE TitleBasics(
        tconst text primary key,
        titleType text,
        primaryTitle text,
        originalTitle text,
        isAdult boolean,
        startYear smallint check(startYear>0),
        endYear smallint check(endYear>=startYear),
        runtimeMinutes int check(runtimeMinutes>=0),
        genres text[]
);