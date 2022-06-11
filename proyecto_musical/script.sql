
create table personas(
 	id serial primary key,
	nombre varchar(50) not null,
	apellido varchar(50),
	email varchar(255) unique not null,
	password varchar(255) not null
);
 
create table usuarios(
 	id integer unique,
	suscripcion_activa bool default true,
	foreign key(id) references personas(id) 
	on delete cascade
);
 
create table artistas(
 	id integer unique,
	nombre_artistico varchar(50),
	verificado bool default false,
	foreign key(id) references personas(id) 
	on delete cascade
);
 
create table album(
 	id serial primary key,
	nombre varchar(50),
	imagen text,
	fecha_lanzamiento date	 
);
 
create table canciones(
 	id serial primary key,
	nombre varchar(255) not null,
	letra text,
	fecha_composicion date
);

create table album_tiene_cancion(
 	id_album integer,
	id_cancion integer,
	primary key(id_album, id_cancion),
	foreign key(id_album) references album(id)
	on delete cascade,
	foreign key(id_cancion) references canciones(id)
	on delete cascade
);

create table artista_compuso_cancion(
	id_artista integer,
	id_cancion integer,
	primary key(id_artista, id_cancion),
	foreign key(id_artista) references artistas(id)
	on delete cascade,
	foreign key(id_cancion) references canciones(id)
	on delete cascade
);

