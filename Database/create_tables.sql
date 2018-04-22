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
ano char(7) primary key,
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
foreign key (operator) references admin(ano),
foreign key (cno) references card(cno) on delete cascade on update cascade,
foreign key (bno) references book(bno) on delete cascade on update cascade
);

create index borrow_cno on borrow(cno);
create index borrow_bno on borrow(bno);
create index borrow_operator on borrow(operator);

alter table book
add check(price>0 and stock>=0 and total>0 and total>=stock);


insert into book values('bno1','计算机','SQL Server 2008完全学习手册','清华出版社',2001,'郭郑州',79.80,5,3);
insert into book values('bno2','计算机','程序员的自我修养','电子工业出版社',2013,'俞甲子',65.00,5,5);
insert into book values('bno3','教育','做新教育的行者','福建教育出版社',2002,'高云鹏',25.00,3,2);
insert into book values('bno4','教育','做孩子眼中有本领的父母','电子工业出版社',2013,'高云鹏',23.00,5,5);
insert into book values('bno5','英语','实用英文写作','高等教育出版社',2008,'庞继贤',33.00,3,2);

insert into card values('cno1','张三','计算机学院','U');
insert into card values('cno2','李四','农学院','U');
insert into card values('cno3','王五','计算机学院','T');
insert into card values('cno4','朱六','计算机学院','G');
insert into card values('cno5','延七','经济学院','O');
insert into card values('cno6','凤姐','经济学院','O');

insert into admin values('ano1','ano1','侯昕李','b3-518-02');
insert into admin values('ano2','ano2','杨赟','b3-518-01');


insert into borrow values('cno1','bno1','2010-6-4','2010-6-10','ano1');
insert into borrow values('cno1','bno2','2010-6-5','2010-6-10','ano1');
insert into borrow values('cno2','bno2','2010-7-4','2010-7-10','ano1');
insert into borrow values('cno3','bno3','2010-8-4','2010-8-10','ano2');
insert into borrow values('cno4','bno4','2010-9-4','2010-9-10','ano2');
