CREATE or replace FUNCTION tconstCheck() --Check si les tconst sont présents dans la table titlebasics
    RETURNS TRIGGER AS
$$
    DECLARE
        t titlebasics.tconst%TYPE;
    BEGIN
        SELECT tconst INTO t
            FROM titlebasics
            WHERE tconst = NEW.tconst;
        IF NOT FOUND THEN
            RETURN NULL;
        END IF;
        RETURN NEW;
    END;

$$ LANGUAGE plpgsql;

CREATE or replace FUNCTION nconstCheck() --Check si les nconst sont présents dans la table namebasics
    RETURNS TRIGGER AS
$$
    DECLARE
        n namebasics.nconst%TYPE;
    BEGIN
        SELECT nconst INTO n
            FROM namebasics
            WHERE nconst = NEW.nconst;
        IF NOT FOUND THEN
            RETURN NULL;
        END IF;
        RETURN NEW;
    END;

$$ LANGUAGE plpgsql;

CREATE or replace FUNCTION parentTconstCheck() --Check si les parentTconst sont présents dans la table titlebasics
    RETURNS TRIGGER AS
$$
    DECLARE
        t titlebasics.tconst%TYPE;
    BEGIN
        SELECT tconst INTO t
            FROM titlebasics
            WHERE tconst = NEW.parenttconst;
        IF NOT FOUND THEN
            RETURN NULL;
        END IF;
        RETURN NEW;
    END;

$$ LANGUAGE plpgsql;


--TRIGGER principals
DROP TRIGGER IF EXISTS principals_check_nconst on titleprincipals;
CREATE TRIGGER principals_check_nconst
    BEFORE INSERT ON titleprincipals
    FOR EACH row
    EXECUTE PROCEDURE nconstCheck();

DROP TRIGGER IF EXISTS principals_check_tconst on titleprincipals;
CREATE TRIGGER principals_check_tconst
    BEFORE INSERT ON titleprincipals
    FOR EACH row
    EXECUTE PROCEDURE tconstCheck();


--TRIGGER episode
DROP TRIGGER IF EXISTS episode_check_tconst on titleepisode;
CREATE TRIGGER episode_check_tconst
    BEFORE INSERT ON titleepisode
    FOR EACH row
    EXECUTE PROCEDURE tconstCheck();

DROP TRIGGER IF EXISTS episode_check_parenttconst on titleepisode;
CREATE TRIGGER episode_check_parenttconst
    BEFORE INSERT ON titleepisode
    FOR EACH row
    EXECUTE PROCEDURE parentTconstCheck();



--TRIGGER crew
DROP TRIGGER IF EXISTS crew_check_tconst on titlecrew;
CREATE TRIGGER crew_check_tconst
    BEFORE INSERT ON titlecrew
    FOR EACH row
    EXECUTE PROCEDURE tconstCheck();


--TRIGGER ratings
DROP TRIGGER IF EXISTS ratings_check_tconst on titleratings;
CREATE TRIGGER ratings_check_tconst
    BEFORE INSERT ON titleratings
    FOR EACH row
    EXECUTE PROCEDURE tconstCheck();




--TRIGGER Function akas
CREATE or replace FUNCTION titleIdCheck() --Check si les tconst sont présents dans la table titlebasics
    RETURNS TRIGGER AS
$$
    DECLARE
        t titlebasics.tconst%TYPE;
    BEGIN
        SELECT tconst INTO t
            FROM titlebasics
            WHERE tconst = NEW.titleid;
        IF NOT FOUND THEN
            RETURN NULL;
        END IF;
        RETURN NEW;
    END;

$$ LANGUAGE plpgsql;

--TRIGGER akas
DROP TRIGGER IF EXISTS akas_check_tconst on titleakas;
CREATE TRIGGER akas_check_tconst
    BEFORE INSERT ON titleakas
    FOR EACH row
    EXECUTE PROCEDURE titleIdCheck();
