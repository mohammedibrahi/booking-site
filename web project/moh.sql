drop database Hotel;
create database Hotel;
use Hotel;
create table Hotel(id int primary key auto_increment,hotel_name varchar(20)not null);
create table Customer(id int primary key ,customer_name varchar(20)not null,age int not null);
create table Room(room_number int primary key,number_of_bed int not null,
price float not null,type_of_room varchar(20) not null,hotel_id int not null references Hotel(id));
create table Reservation(customer_id int not null references Guest(id)ON DELETE CASCADE ON UPDATE CASCADE
,roomnumber int not null references Room(room_number),reservedtime datetime 
);
insert into Hotel(hotel_name)value('the good night');
insert into Room(room_number,number_of_bed,price,type_of_room,hotel_id)values(1001,2,10,'single',1),(22,5,1220,'single',1),(99,2,100,'Married',1),(100,2,110,'single',1),(88,3,120,'Married',1);

