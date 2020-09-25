-- TABLE USERS
CREATE TABLE users(
    id int auto_increment,
    name varchar(50) not null,
    surname varchar(50) not null,
    email varchar(100) not null,
    password varchar(250) not null,
    constraint pk_id PRIMARY KEY (id),
    constraint unique_email UNIQUE (email)
);