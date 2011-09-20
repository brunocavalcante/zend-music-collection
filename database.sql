CREATE TABLE albums (
    id serial NOT NULL,
    name character varying NOT NULL,
    artist_id integer NOT NULL
);


CREATE TABLE artists (
    id serial NOT NULL,
    name character varying NOT NULL
);

ALTER TABLE ONLY albums
    ADD CONSTRAINT albums_pkey PRIMARY KEY (id);

ALTER TABLE ONLY artists
    ADD CONSTRAINT artists_pkey PRIMARY KEY (id);

ALTER TABLE ONLY albums
    ADD CONSTRAINT albums_artist_id_fkey FOREIGN KEY (artist_id) REFERENCES artists(id);


INSERT INTO artists (id, name) VALUES (1, 'The Beatles');

INSERT INTO albums (id, name, artist_id) VALUES (1, 'Please Please Me', 1);
