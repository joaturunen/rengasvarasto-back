-- Database: tirehotel

-- drop database [if exists] tirehotel;

create database tirehotel
with
owner = postgres
ENCODING = 'UTF8'
lc_collate= 'English_Finland.1252'
lc_ctype = 'English_Finland.1252'
tablespace = pg_default
connection limit = -1;

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

create index on employee (
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
customersaved timestamp default current_timestamp,
employee_id int not null,                          
foreign key (employee_id) references employee(id)
on delete restrict
);

create index on customer (
employee_id
);

create table orders (
id smallserial primary key,
orderdate timestamp default current_timestamp,
customer_id int not null,
employee_id int not null,
foreign key (customer_id) references customer(id),
foreign key (employee_id) references employee(id)
on delete restrict
);

create index on orders (
customer_id, employee_id
);

create table services (
id smallserial primary key,
service varchar(50),
price int
);

create table ordertable (
orders_id int primary key, 
services_id int not null,
foreign key (orders_id) references orders(id),
foreign key (services_id) references services(id)
on delete restrict
);

create index on ordertable (
orders_id, services_id 
);

create table car (
register varchar(25) primary key,
brand varchar(25) not null,     
model varchar(25),
year char(4),
customer_id int not null,
foreign key (customer_id) references customer(id)
on delete restrict
);

create index on car (
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

create index on warehouse (
office_id
);

create table shelf (
id smallint primary key, 
warehouse_id int not null,
foreign key (warehouse_id) references warehouse(id)
on delete restrict
);

create index on shelf (
warehouse_id
);

create table slot (
id smallint primary key,
shelf_id smallint not null,
foreign key (shelf_id) references shelf(id)
on delete restrict
);

create index on slot (
shelf_id
);

create table tires (
car_register varchar(25) primary key,
slot_id smallint not null,
brand varchar(25),
model varchar(50),
type varchar(25),
hubcups boolean,
tiresize varchar(25),
tirebolt varchar(25),
groovefl varchar(25),
groovefr varchar(25),
groovebl varchar(25),
groovebr varchar(25),
text text,
rims varchar(25),
servicedate timestamp default current_timestamp,
info text,
foreign key (car_register) references car(register),            
foreign key (slot_id) references slot(id)
on delete restrict
);

create index on tires (
car_register, slot_id
);