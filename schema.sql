Create table USER(
    'id' int(11) not null auto_increment,
    'firstname' varchar(30) not null,
    'lastname' varchar(30) not null,
    'password' varchar(30) not null,
    'email' varchar(30) not null,
    'date_joined' datetime,
    primary key('id')

)
create table ISSUE(
     'id' int(11) not null auto_increment,
     'title' varchar(30) not null,
     'description' text(100) no null,
     'type' varchar(30) not null,
     'priority' varchar(30) not null,
     'status' varchar(30) not null,
     'assigned_to' int(30),
     'created_by ' int(30),
     'created' datetime
     'update' datetime

)