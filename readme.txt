docker run -p 3306:3306 --name mysql1 -e MYSQL_ROOT_PASSWORD=root -d mysql --default-authentication-plugin=mysql_native_password -h 127.0.0.1

mysql -h localhost -u root -p

create table user;
use users;
create table user (
  id int(10) unsigned not null auto_increment,
  firstName varchar(100) not null,
  lastName varchar(100) not null,
  email varchar(100) not null,
  createdAt datetime not null,
  updatedAt datetime null,
  primary key (id));

"vendor/bin/simple-phpunit"