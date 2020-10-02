-- TABLE USERS
CREATE TABLE users(
    id int auto_increment,
    name varchar(50) not null,
    surname varchar(50) not null,
    email varchar(100) not null,
    password varchar(250) not null,
    constraint pk_idUser PRIMARY KEY (id),
    constraint u_emailUser UNIQUE (email)
);

-- TABLE CATEGORIES
CREATE TABLE categories(
    id int auto_increment,
    name varchar(50) not null,
    constraint pk_idCategory PRIMARY KEY (id),
    constraint u_nameCategory UNIQUE (name)
);

-- TABLE ARTICLES
CREATE TABLE articles(
    id int auto_increment,
    user_id int not null,
    category_id int not null,
    title varchar(100) not null,
    description varchar(50000),
    datePublication datetime not null default now(),
    CONSTRAINT pk_idArticle PRIMARY KEY(id),
    CONSTRAINT fk_articles_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_articles_categories FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE NO ACTION
);