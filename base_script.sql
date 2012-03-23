create database bus_mipt CHARACTER SET utf8;
use bus_mipt;

create table main( 
	id int primary key auto_increment, 
	reis_name varchar(100), 
	reis_number varchar(5), 
	start_date datetime, 
	end_date datetime);

	
