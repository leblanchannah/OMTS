use db_omts;

CREATE TABLE theatre_complex(
num_theatres	INTEGER		NOT NULL,
name			VARCHAR(50)	NOT NULL,
street			VARCHAR(50)	NOT NULL,
city			VARCHAR(50) NOT NULL,
postal_code		VARCHAR(6)	NOT NULL,
phone_number	INTEGER		NOT NULL,

PRIMARY KEY(name, street, city, postal_code)
);

CREATE TABLE theatre(
num				INTEGER		NOT NULL,
max_seats		INTEGER		NOT NULL,
screen_size		CHAR(1)	NOT NULL,

name			VARCHAR(50)	NOT NULL,
street			VARCHAR(50)	NOT NULL,
city			VARCHAR(50) NOT NULL,
postal_code		VARCHAR(6)	NOT NULL,

PRIMARY KEY(num, name, street, city, postal_code),
FOREIGN KEY(name, street, city, postal_code) REFERENCES theatre_complex(name, street, city, postal_code)
);

CREATE TABLE showing(
start_time		DATE	NOT NULL,
seats_available			INTEGER	NOT NULL,

title			VARCHAR(100) NOT NULL,
director			VARCHAR(50) NOT NULL,

num				INTEGER		NOT NULL,
name			VARCHAR(50)	NOT NULL,
street			VARCHAR(50)	NOT NULL,
city			VARCHAR(50) NOT NULL,
postal_code		VARCHAR(6)	NOT NULL,

PRIMARY KEY(num, name, street, city, postal_code, start_time, title, director),
FOREIGN KEY(num, name, street, city, postal_code) REFERENCES theatre(num, name, street, city, postal_code),
FOREIGN KEY(title, director) REFERENCES movie(title, director)
);

CREATE TABLE movie(
title			VARCHAR(100) NOT NULL,
director			VARCHAR(50) NOT NULL,
length			DOUBLE		 NOT NULL,
rating			VARCHAR(5),
plot_synopsis	TEXT,
actors			TEXT,
production_company	VARCHAR(50),

supplier_name		VARCHAR(40)	NOT NULL,
supplier_phone_number INTEGER NOT NULL,

PRIMARY KEY(title, director),
FOREIGN KEY(supplier_name, supplier_phone_number) REFERENCES supplier(name, phone_number)
);

CREATE TABLE playing(
start_date  DATE NOT NULL,
end_date    DATE NOT NULL,

name			VARCHAR(50)	NOT NULL,
street			VARCHAR(50)	NOT NULL,
city			VARCHAR(50) NOT NULL,
postal_code		VARCHAR(6)	NOT NULL,

title			VARCHAR(100) NOT NULL,
director			VARCHAR(50) NOT NULL,

PRIMARY KEY(name, street, city, postal_code, title, director),
FOREIGN KEY(name, street, city, postal_code) REFERENCES theatre_complex(name, street, city, postal_code),
FOREIGN KEY(title, director) REFERENCES movie(title, director)
);

CREATE TABLE supplier(
name		VARCHAR(40)	NOT NULL,
street			VARCHAR(50)	NOT NULL,
city			VARCHAR(50) NOT NULL,
postal_code		VARCHAR(6)	NOT NULL,
phone_number			INTEGER NOT NULL,
contact_name		VARCHAR(40) NOT NULL,

PRIMARY KEY(name, phone_number)
);

CREATE TABLE customer(
fname			VARCHAR(50)		NOT NULL,
lname			VARCHAR(50)		NOT NULL,
account_number INTEGER NOT NULL AUTO_INCREMENT,
phone_number	VARCHAR(30),
password  TEXT NOT NULL,
login_id	VARCHAR(50) NOT NULL,
email		VARCHAR(50) NOT NULL,
street			VARCHAR(50),
city			VARCHAR(12),
postal_code		VARCHAR(6),

credit_card_num  VARCHAR(30),
credit_expiry_date DATE,

PRIMARY KEY(account_number)
);

CREATE TABLE admin(
fname			VARCHAR(50)		NOT NULL,
lname			VARCHAR(50)		NOT NULL,
account_number INTEGER NOT NULL AUTO_INCREMENT,
phone_number	VARCHAR(30),
password  TEXT NOT NULL,
login_id	VARCHAR(50) NOT NULL,
email		VARCHAR(50) NOT NULL,
street			VARCHAR(50),
city			VARCHAR(50),
postal_code		VARCHAR(6),

admin_flag BOOLEAN,

PRIMARY KEY(account_number)
);

CREATE TABLE reviews(
review TEXT,

title			VARCHAR(100) NOT NULL,
director			VARCHAR(50),

account_number INTEGER NOT NULL,

PRIMARY KEY(title, director, account_number),
FOREIGN KEY(title, director) REFERENCES movie(title, director),
FOREIGN KEY(account_number) REFERENCES customer(account_number)
);

CREATE TABLE reserves(
account_number	INTEGER		NOT NULL,

num				INTEGER		NOT NULL,
name			VARCHAR(50)	NOT NULL,
street			VARCHAR(50)	NOT NULL,
city			VARCHAR(50) NOT NULL,
postal_code		VARCHAR(6)	NOT NULL,
start_time		DATE	NOT NULL,
title			VARCHAR(100) NOT NULL,
director			VARCHAR(50),

seats_reserved integer NOT NULL,
booking_time DATE NOT NULL,
cancel_flag	BOOLEAN NOT NULL,

PRIMARY KEY(account_number, num, name, street, city, postal_code, start_time, title, director),
FOREIGN KEY(num, name, street, city, postal_code, start_time, title, director) REFERENCES showing(num, name, street, city, postal_code, start_time, title, director),
FOREIGN KEY(account_number) REFERENCES customer(account_number)
);

--  theatre complex
INSERT INTO theatre_complex(num_theatres, name, street, city, postal_code, phone_number)
VALUES (3, "complex_1", "1 Theatre Lane", "Kingston", "F9G6U5", 6131234567);
INSERT INTO theatre_complex(num_theatres, name, street, city, postal_code, phone_number)
VALUES (2, "complex_2", "2 Cinema Avenue", "Calgary", "Y8I4O0", 1111111111);
INSERT INTO theatre_complex(num_theatres, name, street, city, postal_code, phone_number)
VALUES (1, "complex_3", "17 Star Wars Park", "Toronto", "M1W4Z2", 123456789);

-- theatre
INSERT INTO theatre(num, max_seats, screen_size, name, street, city, postal_code)
VALUES (1, 10, "S", "complex_1", "1 Theatre Lane", "Kingston", "F9G6U5");
INSERT INTO theatre(num, max_seats, screen_size, name, street, city, postal_code)
VALUES (2, 15, "M", "complex_1", "1 Theatre Lane", "Kingston", "F9G6U5");
INSERT INTO theatre(num, max_seats, screen_size, name, street, city, postal_code)
VALUES (3, 25, "L", "complex_1", "1 Theatre Lane", "Kingston", "F9G6U5");

INSERT INTO theatre(num, max_seats, screen_size, name, street, city, postal_code)
VALUES (1, 10, "S", "complex_2", "2 Cinema Avenue", "Calgary", "Y8I4O0");
INSERT INTO theatre(num, max_seats, screen_size, name, street, city, postal_code)
VALUES (2, 20, "M", "complex_2", "2 Cinema Avenue", "Calgary", "Y8I4O0");

INSERT INTO theatre(num, max_seats, screen_size, name, street, city, postal_code)
VALUES (1, 13, "S", "complex_3", "17 Star Wars Park", "Toronto", "M1W4Z2");

-- showing
INSERT INTO showing(start_time,seats_available,title,director,num,name,street,city,postal_code)
VALUES ("2222-08-05",11,"FAST FIFTY","Arfus Chen", 1, "complex_1", "1 Theatre Lane", "Kingston", "F9G6U5");
INSERT INTO showing(start_time,seats_available,title,director,num,name,street,city,postal_code)
VALUES ("2222-08-05",21,"RECURSION RECURSION","Hann Leblank", 2, "complex_2", "2 Cinema Avenue", "Calgary", "Y8I4O0");

-- movie
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_name, supplier_phone_number)
VALUES ("FAST FIFTY", "Arfus Chen", 1, "G", "Go fast. Go furious", "Dude_1", "My house", "Their house", 123123123);
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_name, supplier_phone_number)
VALUES ("RECURSION RECURSION", "Hann Leblank", 2, "R", "Recursive. Recursion", "Gal_1", "Her house", "His house", 123456123);

-- playing
INSERT INTO playing(start_date, end_date, name, street, city, postal_code, title, director)
VALUES ("2018-03-03", "2021-06-15", "complex_1","1 Theatre Lane", "Kingston", "F9G6U5", "FAST FIFTY", "Arfus Chen");
INSERT INTO playing(start_date, end_date, name, street, city, postal_code, title, director)
VALUES ("2019-03-03", "2021-06-15", "complex_2", "2 Cinema Avenue", "Calgary", "Y8I4O0", "RECURSION RECURSION", "Hann Leblank");
INSERT INTO playing(start_date, end_date, name, street, city, postal_code, title, director)
VALUES ("2019-03-03", "2021-06-15", "complex_3", "17 Star Wars Park", "Toronto", "M1W4Z2", "RECURSION RECURSION", "Hann Leblank");

-- supplier
INSERT INTO supplier(name, street, city, postal_code, phone_number, contact_name)
VALUES ("supplier_1", "1234 Supplier Road", "Vancouver", "F8Y8U9", 9586748590, "person name");
INSERT INTO supplier(name, street, city, postal_code, phone_number, contact_name)
VALUES ("supplier_2", "675849 Main Street - Unit 3", "Edmonton", "A7H4O1", 3859481728, "Abby Chan");

-- customer
INSERT INTO customer (fname, lname,phone_number,password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("Hannah","LeBlanc",6136136133,"HELLO", "hanskisj","hannah.leblanc@queensu.ca","10 Main Street","Kingston","W3R499","1111111111111111","2021-06-00");

INSERT INTO customer (fname, lname,phone_number,password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("Christopher","Ko",4164164166,"WHAT", "chrissycakez","chris.ko@queensu.ca","400 Byward Street","Kingston","W3K779","2222222222222222","2021-08-00");

INSERT INTO customer (fname, lname,phone_number,password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("Alfred","Chen",7897897899,"UP", "alfredlixi","alfred.chen@queensu.ca","32 King Street","Kingston","W33GH9","3333333333333333","2021-07-00");

-- admin
INSERT INTO admin (fname, lname,phone_number,password, login_id, email, street, city, postal_code, admin_flag)
VALUES ("Admin","InCharge",9999999999, "admin", "admin","admin.admin@queensu.ca","1 Admin Avenue","Kingston","H1H2H1",true);

-- reviews
INSERT INTO reviews(review, title, director, account_number)
VALUES ("This movie just kept repeating the first 5 minutes of the film.", "RECURSION RECURSION", "Hann Leblank", 1);

-- reserves
INSERT INTO reserves(account_number, num, name, street, city, postal_code, start_time, title, director, seats_reserved, booking_time, cancel_flag)
VALUES (1, 1, "complex_3", "17 Star Wars Park", "Toronto", "M1W4Z2", "2222-08-05", "FAST FIFTY", "Arfus Chen", 5, "2018-07-02", false);
