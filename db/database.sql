create database portafolio;

use portafolio;

create table usuarios(
    id int primary key auto_increment,
    usuario varchar(255) unique,
    password varchar(255),
    nombre varchar(255),
    apellido varchar(255),
    estado boolean default true
);

create table proyectos(
    id int primary key auto_increment,
    nombre varchar(255),
    imagen varchar(255),
    descripcion text,
    descripcion_corta text,
    fecha datetime default current_timestamp,
    estado boolean default true,
    usuario_id int,
    foreign key (usuario_id) references usuarios(id)
);

insert into usuarios(usuario, password, nombre, apellido) values('admin', '123', 'admin', 'admin');

insert into proyectos(nombre, imagen, descripcion, descripcion_corta, usuario_id) values('Proyecto 1', 'imagen1.jpg', 'Descripcion 1', 'Descripcion 1', 1);
insert into proyectos(nombre, imagen, descripcion, descripcion_corta, usuario_id) values('Proyecto 2', 'imagen2.jpg', 'Descripcion 2', 'Descripcion 2', 1);
insert into proyectos(nombre, imagen, descripcion, descripcion_corta, usuario_id) values('Proyecto 3', 'imagen3.jpg', 'Descripcion 3', 'Descripcion 3', 1);

