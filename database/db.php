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
title varchar(25) not null
);

create table employee (
id smallserial primary key,
firstname varchar(25) not null,
lastname varchar(25) not null,
phone varchar(25) not null unique,
email varchar(25) not null unique,
address varchar(50) not null,
zipcode char(5) not null,
city varchar(25) not null,
login varchar(25) not null unique,
password varchar(25) not null,
role_id int not null,
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
email varchar(25) not null unique,
address varchar(50) not null,
zipcode char(5) not null,
city varchar(25) not null,
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
service varchar(50) not null,
price int not null
);

create table ordertable (
id smallserial primary key,
services_id int not null,
foreign key (services_id) references services(id)
on delete restrict
);

create index on ordertable (
services_id
);

create table car (
id smallserial primary key,
register varchar(25) not null unique,
brand varchar(25) not null,
model varchar(25) not null,
tiresize varchar(25) not null,
tirebolt varchar(25) not null
);

create table office (
id smallserial primary key,
name varchar(25) not null unique,
phone varchar(25) not null unique,
email varchar(25) not null unique,
address varchar(25) not null,
zipcode char(5) not null,
city varchar(25) not null,
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
id smallserial primary key,
warehouse_id int not null,
foreign key (warehouse_id) references warehouse(id)
on delete restrict
);

create index on shelf (
warehouse_id
);

create table slot (
id smallserial primary key,
shelf_id int not null,
foreign key (shelf_id) references shelf(id)
on delete restrict
);

create index on slot (
shelf_id
);

create table tires (
id smallserial primary key,
customer_id int not null,
car_id int not null,
slot_id int not null,
employee_id int not null,
brand varchar(25) not null,
model varchar(50) not null,
type varchar(25) not null,
dustrims varchar(25) not null,
groovefl varchar(25) not null,
groovefr varchar(25) not null,
groovebl varchar(25) not null,
groovebr varchar(25) not null,
text text,
rims varchar(25) not null,
servicedate timestamp default current_timestamp,
info text,
foreign key (customer_id) references customer(id),
foreign key (car_id) references car(id),
foreign key (slot_id) references slot(id),
foreign key (employee_id) references employee(id)
on delete restrict
);

create index on tires (
customer_id, car_id, slot_id, employee_id
);