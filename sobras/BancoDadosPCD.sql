create database proj_ged;

use proj_ged;

drop database proj_ged;


create table classe (
		id_classe int not null auto_increment primary key,
        nome varchar(255),
		cod_classe int not null,
		subordinacao varchar(255),
		ativada date,
		desativada date,
		reativada date,
		alterada date,
		deslocada date,
		deletada date,
		status_classe varchar(1)
);

create table subclasse (
	id_subclasse int not null auto_increment,
    nome_subclasse varchar(255),
    cod_subclasse int not null,
    id_classe int not null,
    primary key (id_subclasse),
    foreign key (id_classe) references classe(id_classe)
);

create table grupo (
	id_grupo int not null auto_increment,
    nome_grupo varchar(255),
    cod_grupo int not null,
    id_subclasse int not null,
    primary key (id_grupo),
    foreign key (id_subclasse) references subclasse(id_subclasse)
);

create table subgrupo (
	id_subgrupo int not null auto_increment,
    nome_subgrupo varchar(255),
    cod_subgrupo int not null,
    id_grupo int not null,
    primary key (id_subgrupo),
    foreign key (id_grupo) references grupo(id_grupo)
);

create table documento (
	id_doc int not null auto_increment,
    nome_doc varchar(255),
    cod_doc int not null,
    desc_doc varchar(255),
    id_subgrupo int not null,
    primary key (id_doc),
    foreign key (id_subgrupo) references subgrupo(id_subgrupo)
);

select * from grupo;
select codigo, nome, reg_enable, status_classe from classe where codigo = 200;
select * from subclasse where id_classe=100;

insert into grupo(nome_grupo,cod_grupo,id_subclasse) values ('Paralelismo','111','3');

delete from classe where cod_classe = 110;

select * from subgrupo;

insert into subgrupo(nome_subgrupo,cod_subgrupo,id_grupo) values ('Programacao A','1112','1');

select * from classe documento;


delete from documento;
delete from subgrupo;
delete from grupo;
delete from subclasse;
delete from classe;