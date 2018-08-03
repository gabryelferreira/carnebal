create database dbCarnebal;

use dbCarnebal;

create table tbFuncionario(
cdFuncionario int not null auto_increment,
cpf char(11),
nomeFuncionario varchar(100),
endereco varchar(200),
complemento varchar(50),
ddd char(2),
telefone varchar(11),
sexo char(1),
dtNascimento date,
cargo varchar(6),
email varchar(100),
usuario char(12),
senha varchar(255),
foto varchar(255),
primeiroAcesso boolean,
isAtivo boolean,
primary key (cdFuncionario)
);

create table tbProduto(
cdProduto int not null auto_increment,
nomeProduto varchar (20),
descricao varchar (120),
precoUnitario decimal(6,2),
foto varchar(255),
primary key (cdProduto)
);

create table tbComanda(
cdComanda int not null auto_increment,
dtComanda date not null,
hrComanda time not null,
vlTotal decimal (7,2),
cdFuncionario int not null,
cdCliente int,
numComandaFisica int,
numMesa int,
isAtivo boolean,
primary key (cdComanda),
foreign key (cdFuncionario) references tbFuncionario(cdFuncionario)
);


create table tbControle(
cdControle int not null auto_increment,
cdProduto int not null,
qtProduto int not null,
vlControle decimal (8,2) not null,
cdComanda int not null,
primary key (cdControle),
foreign key (cdProduto) references tbProduto(cdProduto),
foreign key (cdComanda) references tbComanda(cdComanda),
UNIQUE KEY `ix_Controle` (cdProduto, cdComanda)
);