CREATE TABLE albums (
    id serial NOT NULL,
    name character varying NOT NULL,
    year integer, 
    artist_id integer NOT NULL, 
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

CREATE TABLE users (
    id serial NOT NULL,
    username character varying NOT NULL,
    password character varying NOT NULL, 
    name character varying NOT NULL
);

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);

INSERT INTO users (id, username, password, name) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');