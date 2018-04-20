create table book (
bno char(10) primary key, 
category varchar(30),
title varchar(40),
press varchar(30),
year int,
author varchar(20),
price decimal(7,2),
total int,
stock int
);

create table card(
cno char(7) primary key,
name varchar(10),
department varchar(40),
type char(1), 
check (type in ('T','G','U','O'))
);

create table admin(
ID char(5) primary key,
password varchar(20),
name varchar(15),
contact varchar(40)
);

create table borrow(
cno char(7),
bno char(10),
borrow_date date,
return_date date,
operator char(5),
foreign key (operator) references admin(ID),
foreign key (cno) references card(cno) on delete cascade on update cascade,
foreign key (bno) references book(bno) on delete cascade on update cascade
);

create index borrow_cno on borrow(cno);
create index borrow_bno on borrow(bno);
create index borrow_operator on borrow(operator);
