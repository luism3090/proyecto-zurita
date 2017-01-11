create database zurita;
use zurita;

create table usuarios (
    id int unsigned auto_increment,
    usuario varchar(30) not null,
    contra varchar(60) not null,
	nombre varchar(30) not null,
	apellido varchar(30) not null,
    constraint pk_usuario primary key(id)
) engine=InnoDB, charset=utf8;

create table domicilios (
	id int unsigned auto_increment,
	calle varchar(30) not null,
	calle2 varchar(30) not null,
	numero varchar(30) not null,
	colonia varchar(30) not null,
	ciudad varchar(30),
	municipio varchar(30),
	estado varchar(30),
	pais varchar(30),
	referencia varchar(120) not null,
	constraint pk_domicilios primary key(id)
) engine=InnoDB, charset=utf8;

create table clientes (
	id int unsigned auto_increment,
	nombre varchar(30) not null,
	apellidop varchar(30) not null,
	apellidom varchar(30),
	titulo varchar(30),
	razon_social varchar(30),
	rfc varchar(30),
	domicilio int unsigned,
	constraint pk_clientes primary key(id)
) engine=InnoDB, charset=utf8;

create table empleados (
	id int unsigned auto_increment,
	nombre varchar(30) not null,
	apellidop varchar(30) not null,
	apellidom varchar(30),
	titulo varchar(30),
	domicilio int unsigned,
	constraint pk_empleados primary key(id)
) engine=InnoDB, charset=utf8;

create table categorias (
	id int unsigned auto_increment,
	nombre varchar(30) not null,
	categoria int unsigned null,
	constraint pk_categorias primary key(id)
) engine=InnoDB, charset=utf8;

create table udms (
	id int unsigned auto_increment,
	nombre varchar(30) not null,
	tipo int(1) not null,
	constraint pk_umds primary key(id)
) engine=InnoDB, charset=utf8;

create table materiales (
	id int unsigned auto_increment,
	codigo varchar(30) not null,
	nombre varchar(30) not  null,
	descripcion varchar(200) not null,
	categoria int unsigned,
	udm int unsigned,
	compra double,
	venta double,
	constraint pk_materiales primary key(id)
) engine=InnoDB, charset=utf8;

create table obra_tipos (
	id int unsigned auto_increment,
	nombre varchar(30) not null,
	constraint pk_obra_tipos primary key(id)
) engine=InnoDB, charset=utf8;

create table obras (
	id int unsigned auto_increment,
	nombre varchar(30) not null,
	descripcion varchar(200),
	cliente int unsigned,
	tipo int unsigned,
	presupuesto int unsigned,
	estado varchar(30),
	constraint pk_obras primary key(id)
) engine=InnoDB, charset=utf8;

create table trabaja_en (
	empleado int unsigned,
	obra int unsigned,
	constraint pk_trabaja_en primary key(empleado, obra)
) engine=InnoDB, charset=utf8;

create table presupuestos (
	id int unsigned auto_increment,
	elaboro int unsigned,
	autorizo int unsigned,
	constraint pk_presupuesto primary key(id)
) engine=InnoDB, charset=utf8;

create table contiene (
	id int unsigned auto_increment,
	presupuesto int unsigned,
	material int unsigned,
	cantidad double,
	precio double,
	constraint pk_contiene primary key(id)
) engine=InnoDB, charset=utf8;

-- create unique index idx_presupuesto on contiene(presupuesto, material);