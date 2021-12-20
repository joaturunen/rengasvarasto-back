-- Database: tirehotel

-- drop database [if exists] tirehotel;

-- create database tirehotel
-- with
-- owner = postgres
-- ENCODING = 'UTF8'
-- lc_collate= 'Finnish_Finland.1252'
-- lc_ctype = 'Finnish_Finland.1252'
-- tablespace = pg_default
-- connection limit = -1;
alter database "tirehotel" set datestyle to "German, DMY";

create table role (
id smallserial primary key,
title varchar(25)
);

create table employee (
id smallserial primary key,
firstname varchar(25) not null,
lastname varchar(25) not null,
phone varchar(25) not null unique,
email varchar(50) not null unique,
address varchar(50),
zipcode char(5),
city varchar(25),
login varchar(25) not null unique,
password varchar(25) not null,
role_id int,
foreign key (role_id) references role(id)
on delete restrict
);

create index role_index on employee (
role_id
);

create table customer (
id smallserial primary key,
firstname varchar(25) not null,
lastname varchar(25) not null,
phone varchar(25) not null unique,
email varchar(50) not null unique,
address varchar(50),
zipcode char(5),
city varchar(25),
customersaved date default current_timestamp,
employee_id int not null,                          
foreign key (employee_id) references employee(id)
on delete restrict
);

create index employee_index on customer (
employee_id
);



create table car (
id smallserial primary key,
register varchar(25) unique,
brand varchar(25) not null,     
model varchar(25),
customer_id int not null,
foreign key (customer_id) references customer(id)
on delete restrict
);

create index car_index on car (
customer_id
);

create table office (
id smallserial primary key,
name varchar(25) not null unique,
phone varchar(25) not null unique,
email varchar(25) not null unique,
address varchar(25),
zipcode char(5),
city varchar(25),
logo varchar(25)
);

create table warehouse (
id smallserial primary key,
name varchar(25),
office_id int not null,
foreign key (office_id) references office(id)
on delete restrict
);

create index warehouse_index on warehouse (
office_id
);

create table shelf (
id smallint primary key, 
warehouse_id int not null,
foreign key (warehouse_id) references warehouse(id)
on delete restrict
);

create index shelf_index on shelf (
warehouse_id
);

create table slot (
id smallint primary key,
shelf_id smallint not null,
foreign key (shelf_id) references shelf(id)
on delete restrict
);

create index slot_index on slot (
shelf_id
);

create table tires (
id smallserial primary key,
car_id int not null,
brand varchar(25),
model varchar(50),
type varchar(25),
hubcups varchar(25),
tiresize varchar(25),
tirebolt varchar(25),
groovefl varchar(25),
groovefr varchar(25),
groovebl varchar(25),
groovebr varchar(25),
text text,
rims varchar(25),
servicedate date default current_timestamp,
foreign key (car_id) references car(id)
);

create index tires_index on tires (
car_id
);

create table season (
  id smallserial primary key,
  name varchar(20)
);

create table orders (
id smallserial primary key,
orderdate date default current_timestamp,
customer_id int not null,
employee_id int not null,
foreign key (customer_id) references customer(id),
foreign key (employee_id) references employee(id)
on delete restrict
);

create index orders_index on orders (
customer_id, employee_id
);

create table category (
  id smallserial primary key,
  name varchar(50)
);

create table services (
id smallserial primary key,
service varchar(50) not null,
price decimal(5,2),
category_id int not null,
season_id int,
foreign key (season_id) references season(id),
foreign key (category_id) references category(id)
);


create table orderline (
id smallserial primary key,
orders_id int not null, 
services_id int not null,
tires_id int,
foreign key (orders_id) references orders(id),
foreign key (services_id) references services(id)
on delete restrict,
foreign key (tires_id) references tires(id)
on delete restrict
);

create index orderline_index on orderline (
orders_id, services_id 
);

create table slot_order (
slot_id int not null,
orderline_id int,
foreign key (orderline_id) references orderline(id) on delete restrict,
foreign key (slot_id) references slot(id)
);
