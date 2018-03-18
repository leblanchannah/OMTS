use db_omts;

CREATE TABLE theatre_complex(
num_theatres	INTEGER		NOT NULL,
name			VARCHAR(50)	NOT NULL,
street			VARCHAR(50)	NOT NULL,
city			VARCHAR(50) NOT NULL,
postal_code		VARCHAR(6)	NOT NULL,
phone_number	INTEGER		NOT NULL,

PRIMARY KEY(name)
);

CREATE TABLE theatre(
num				INTEGER		NOT NULL,
max_seats		INTEGER		NOT NULL,
screen_size		CHAR(1)	NOT NULL,

name			VARCHAR(50)	NOT NULL,

PRIMARY KEY(num, name),
FOREIGN KEY(name) REFERENCES theatre_complex(name)
);

CREATE TABLE showing(
start_time		DATETIME	NOT NULL,
seats_available			INTEGER	NOT NULL,

movie_id INTEGER NOT NULL,

num				INTEGER		NOT NULL,
name			VARCHAR(50)	NOT NULL,

PRIMARY KEY(num, name, start_time, movie_id),
FOREIGN KEY(num, name) REFERENCES theatre(num, name),
FOREIGN KEY(movie_id) REFERENCES movie(movie_id)
);

CREATE TABLE movie(
movie_id      INTEGER NOT NULL AUTO_INCREMENT,
title			VARCHAR(100) NOT NULL,
director			VARCHAR(50) NOT NULL,
length			DOUBLE		 NOT NULL,
rating			VARCHAR(5),
plot_synopsis	TEXT,
actors			TEXT,
production_company	VARCHAR(50),

supplier_phone_number VARCHAR(30) NOT NULL,

PRIMARY KEY(movie_id),
FOREIGN KEY(supplier_phone_number) REFERENCES supplier(phone_number)
);

CREATE TABLE playing(
start_date  DATE NOT NULL,
end_date    DATE NOT NULL,

name			VARCHAR(50)	NOT NULL,

movie_id INTEGER NOT NULL,

PRIMARY KEY(name, movie_id),
FOREIGN KEY(name) REFERENCES theatre_complex(name),
FOREIGN KEY(movie_id) REFERENCES movie(movie_id)
);

CREATE TABLE supplier(
name		VARCHAR(40)	NOT NULL,
street			VARCHAR(50)	NOT NULL,
city			VARCHAR(50) NOT NULL,
postal_code		VARCHAR(6)	NOT NULL,
phone_number			VARCHAR(30) NOT NULL,
contact_name		VARCHAR(40) NOT NULL,

PRIMARY KEY(phone_number)
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

movie_id INTEGER NOT NULL,

account_number INTEGER NOT NULL,

PRIMARY KEY(movie_id, account_number),
FOREIGN KEY(movie_id) REFERENCES movie(movie_id),
FOREIGN KEY(account_number) REFERENCES customer(account_number) ON DELETE CASCADE
);

CREATE TABLE reserves(
account_number	INTEGER		NOT NULL,

num				INTEGER		NOT NULL,
name			VARCHAR(50)	NOT NULL,
start_time		DATE	NOT NULL,
movie_id INTEGER NOT NULL,

seats_reserved integer NOT NULL,
booking_time DATE NOT NULL,
cancel_flag	BOOLEAN NOT NULL,

PRIMARY KEY(account_number, num, name, start_time, movie_id),
FOREIGN KEY(num, name, start_time, movie_id) REFERENCES showing(num, name, start_time, movie_id),
FOREIGN KEY(account_number) REFERENCES customer(account_number) ON DELETE CASCADE
);

--  theatre complex
INSERT INTO theatre_complex VALUES (3, "complex_1", "1 Theatre Lane", "Kingston", "F9G6U5", 6131234567);
INSERT INTO theatre_complex VALUES (2, "complex_2", "2 Cinema Avenue", "Calgary", "Y8I4O0", 1111111111);
INSERT INTO theatre_complex VALUES (1, "complex_3", "17 Star Wars Park", "Toronto", "M1W4Z2", 123456789);

-- theatre
INSERT INTO theatre VALUES (1, 10, "S", "complex_1");
INSERT INTO theatre VALUES (2, 15, "M", "complex_1");
INSERT INTO theatre VALUES (3, 25, "L", "complex_1");

INSERT INTO theatre VALUES (1, 10, "S", "complex_2");
INSERT INTO theatre VALUES (2, 20, "M", "complex_2");

INSERT INTO theatre VALUES (1, 13, "S", "complex_3");

-- showing
INSERT INTO showing VALUES ("2018-03-23", 10, 1, 1, "complex_1");
INSERT INTO showing VALUES ("2018-03-23", 15, 2, 2, "complex_2");
INSERT INTO showing VALUES ("2018-03-23", 10, 3, 1, "complex_3");
INSERT INTO showing VALUES ("2222-08-05", 10, 1, 1, "complex_1");
INSERT INTO showing VALUES ("2222-08-05", 14, 2, 2, "complex_2");

-- movie
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
VALUES ("FAST FIFTY", "Arfus Chen", 1.3, "G", "Go fast. Go furious", "Dude_1", "My house", 9586748590);
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
VALUES ("RECURSION RECURSION", "Hann Leblank", 2.5, "R", "Recursive. Recursion", "Gal_1", "Her house", 3859481728);
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
VALUES ("Another Fun Movie", "Hann Leblank", 1.78, "R", "This one is better.", "Gal_1,Dude_1", "Her house", 6472945648);

-- playing
INSERT INTO playing VALUES ("2018-03-24", "2021-06-15", "complex_1", 1);
INSERT INTO playing VALUES ("2018-03-24", "2021-06-15", "complex_2", 2);
INSERT INTO playing VALUES ("2018-03-24", "2021-06-15", "complex_3", 2);
INSERT INTO playing VALUES ("2018-03-24", "2021-06-15", "complex_3", 3);

-- supplier
INSERT INTO supplier VALUES ("supplier_1", "1234 Supplier Road", "Vancouver", "F8Y8U9", 9586748590, "person name");
INSERT INTO supplier VALUES ("supplier_2", "675849 Main Street - Unit 3", "Edmonton", "A7H4O1", 3859481728, "Abby Chan");
INSERT INTO supplier VALUES ("supplier_3", "9876 Supplier Road", "Kingston", "A7Y3G9", 6472945648, "person name 2");

-- customer
INSERT INTO customer(fname, lname, phone_number, password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("Hannah", "LeBlanc", 6136136133, "HELLO", "hanskisj", "hannah.leblanc@queensu.ca", "10 Main Street", "Kingston", "W3R499", "1111111111111111", "2021-06-00");
INSERT INTO customer(fname, lname, phone_number, password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("Christopher", "Ko", 4164164166, "WHAT", "chrissycakez", "chris.ko@queensu.ca", "400 Byward Street", "Kingston", "W3K779", "2222222222222222", "2021-08-00");
INSERT INTO customer(fname, lname, phone_number, password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("Alfred", "Chen", 7897897899, "UP", "alfredlixi", "alfred.chen@queensu.ca", "32 King Street", "Kingston", "W33GH9", "3333333333333333", "2021-07-00");

-- admin
INSERT INTO admin(fname, lname, phone_number, password, login_id, email, street, city, postal_code, admin_flag)
VALUES ("Admin", "InCharge", 9999999999, "admin", "admin", "admin.admin@queensu.ca", "1 Admin Avenue", "Kingston", "H1H2H1", true);
INSERT INTO admin(fname, lname, phone_number, password, login_id, email, street, city, postal_code, admin_flag)
VALUES ("Root", "Admin", 1234567823, "root", "toor", "root@queensu.ca", "1 Admin Avenue", "Kingston", "H1H2H1", true);
INSERT INTO admin(fname, lname, phone_number, password, login_id, email, street, city, postal_code, admin_flag)
VALUES ("Admin", "Istrator", 6548930495, "brother", "hunter2", "administrator@queensu.ca", "1 Admin Avenue", "Kingston", "H1H2H1", true);

-- reviews
INSERT INTO reviews VALUES ("This movie just kept repeating the first 5 minutes of the film.", 2, 1);
INSERT INTO reviews VALUES ("This movie just kept repeating the first 2 minutes of the film.", 2, 2);
INSERT INTO reviews VALUES ("This movie just kept repeating the first 15 minutes of the film.", 1, 3);
INSERT INTO reviews VALUES ("Would watch again.", 1, 1);
INSERT INTO reviews VALUES ("5/5", 3, 2);

-- reserves
INSERT INTO reserves VALUES (1, 1, "complex_3", "2018-03-24", 1, 1, "2018-03-02", false);
INSERT INTO reserves VALUES (2, 1, "complex_3", "2018-03-24", 1, 1, "2018-03-02", false);
INSERT INTO reserves VALUES (3, 1, "complex_3", "2018-03-24", 1, 1, "2018-03-02", false);
INSERT INTO reserves VALUES (2, 1, "complex_2", "2018-03-24", 2, 1, "2018-03-02", false);
