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
FOREIGN KEY(name) REFERENCES theatre_complex(name) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE showing(
start_time		DATETIME	NOT NULL,
movie_id INTEGER NOT NULL,

num				INTEGER		NOT NULL,
name			VARCHAR(50)	NOT NULL,

PRIMARY KEY(num, name, start_time, movie_id),
FOREIGN KEY(num, name) REFERENCES theatre(num, name) ON UPDATE CASCADE,
FOREIGN KEY(movie_id) REFERENCES movie(movie_id) ON UPDATE CASCADE
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
FOREIGN KEY(name) REFERENCES theatre_complex(name) ON DELETE CASCADE ON UPDATE CASCADE,
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
start_time		DATETIME	NOT NULL,
movie_id INTEGER NOT NULL,

seats_reserved integer NOT NULL,
booking_time DATE NOT NULL,
cancel_flag	BOOLEAN NOT NULL,

PRIMARY KEY(account_number, num, name, start_time, movie_id),
FOREIGN KEY(num, name, start_time, movie_id) REFERENCES showing(num, name, start_time, movie_id) ON UPDATE CASCADE,
FOREIGN KEY(account_number) REFERENCES customer(account_number) ON DELETE CASCADE
);

--  theatre complex
INSERT INTO theatre_complex VALUES (6, "complex_1", "1 Theatre Lane", "Kingston", "F9G6U5", 6131234567);
INSERT INTO theatre_complex VALUES (4, "complex_2", "2 Cinema Avenue", "Calgary", "Y8I4O0", 1111111111);
INSERT INTO theatre_complex VALUES (3, "complex_3", "17 Star Wars Park", "Toronto", "M1W4Z2", 123456789);

-- theatre
INSERT INTO theatre VALUES (1, 100, "S", "complex_1");
INSERT INTO theatre VALUES (2, 150, "M", "complex_1");
INSERT INTO theatre VALUES (3, 250, "L", "complex_1");
INSERT INTO theatre VALUES (4, 200, "M", "complex_1");
INSERT INTO theatre VALUES (5, 200, "M", "complex_1");
INSERT INTO theatre VALUES (6, 300, "L", "complex_1");

INSERT INTO theatre VALUES (1, 100, "S", "complex_2");
INSERT INTO theatre VALUES (2, 200, "M", "complex_2");
INSERT INTO theatre VALUES (3, 100, "S", "complex_2");
INSERT INTO theatre VALUES (4, 200, "M", "complex_2");

INSERT INTO theatre VALUES (1, 100, "S", "complex_3");
INSERT INTO theatre VALUES (2, 100, "S", "complex_3");
INSERT INTO theatre VALUES (3, 100, "S", "complex_3");


-- showing

INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 1, 1, "complex_1");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 2, 2, "complex_1");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 3, 3, "complex_1");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 4, 4, "complex_1");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 5, 5, "complex_1");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 6, 6, "complex_1");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 1, 1, "complex_2");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 2, 2, "complex_2");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 5, 3, "complex_2");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 6, 4, "complex_2");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 1, 1, "complex_3");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 2, 2, "complex_3");
INSERT INTO showing(start_time, movie_id, num, name) VALUES ("2018-03-23 19:00:00", 3, 3, "complex_3");


-- movie
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
VALUES ("FAST FIFTY", "Arfus Chen", 1.3, "G", "Go fast. Go furious", "Dude_1", "My house", 9586748590);
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
VALUES ("RECURSION RECURSION", "Hann Leblank", 2.5, "R", "Recursive. Recursion", "Gal_1", "Her house", 3859481728);
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
VALUES ("Another Fun Movie", "Hann Leblank", 1.78, "R", "This one is better.", "Gal_1,Dude_1", "Her house", 6472945648);
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
VALUES ("The Shawshank Redemption", "Frank Darabont", 142, "R", "Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.", " Tim Robbins, Morgan Freeman, Bob Gunton", "Castle Rock Entertainment", 6472945648);
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
VALUES ("The Godfather", "Francis Ford Coppola", 175, "R", "The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.", "Marlon Brando, Al Pacino, James Caan", "Paramount Pictures", 6472945648);
INSERT INTO movie(title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
VALUES ("The Dark Knight", "Christopher Nolan", 152, "R", "When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham, the Dark Knight must accept one of the greatest psychological and physical tests of his ability to fight injustice.", "Christian Bale, Heath Ledger, Aaron Eckhart", "Warner Bros.", 6472945648);

-- playing
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_1", 1);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_1", 2);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_1", 3);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_1", 4);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_1", 5);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_1", 6);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_2", 1);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_2", 2);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_2", 5);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_2", 6);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_3", 1);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_3", 2);
INSERT INTO playing VALUES ("2018-03-20", "2018-06-15", "complex_3", 3);


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
INSERT INTO customer(fname, lname, phone_number, password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("test4fname", "test4lname", 123123456, "test4", "test4", "test4@queensu.ca", "32 King Street", "Kingston", "W33GH9", "3333333399933333", "2021-07-00");
INSERT INTO customer(fname, lname, phone_number, password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("test1fname", "test1lname", 123123456, "test1", "test1", "test1@queensu.ca", "32 King Street", "Kingston", "W33GH9", "3333333399333333", "2021-07-00");
INSERT INTO customer(fname, lname, phone_number, password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("test2fname", "test2lname", 123723456, "test2", "test2", "test2@queensu.ca", "32 King Street", "Kingston", "W33GH9", "3333333399333303", "2021-07-00");
INSERT INTO customer(fname, lname, phone_number, password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
VALUES ("test3fname", "test3lname", 193123456, "test2", "test2", "test2@queensu.ca", "32 King Street", "Kingston", "W33GH9", "3343333399333333", "2021-07-00");


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

INSERT INTO reviews VALUES ("I have never seen such an amazing film since I saw The Shawshank Redemption. Shawshank encompasses friendships, hardships, hopes, and dreams. And what is so great about the movie is that it moves you, it gives you hope. Even though the circumstances between the characters and the viewers are quite different, you don't feel that far removed from what the characters are going through.",4,4);
INSERT INTO reviews VALUES ("Tell me a movie that is more famous than this. Tell me a movie that has had more parodies spinned off its storyline than this. Tell me one movie that has been as quoted as a much as this. The answer is you can't. No movie has had as much of an impact as The Godfather has had ever since it was released.",5,4);
INSERT INTO reviews VALUES ("We've been subjected to enormous amounts of hype and marketing for the Dark Knight. We've seen Joker scavenger hunts and one of the largest viral campaigns in advertising history and it culminates with the actual release of the movie. Everything that's been said is pretty much spot on. This is the first time I can remember where a summer blockbuster film far surpasses the hype.For as much action as there is in this movie, it's the acting that makes it a great piece of work. Between all the punches, explosions and stunt-work is some great dialog work. All the actors have their moments.",6,4);


-- reserves
-- account, num, name, start time, movie_id,seats_reserved,booking_time,cancel_flag,
INSERT INTO reserves VALUES (1, 1, "complex_3", "2018-03-23 19:00:00", 1, 11, "2018-03-20 12:00:00", false);
INSERT INTO reserves VALUES (2, 3, "complex_2", "2018-03-23 19:00:00", 5, 3, "2018-03-20 12:00:02", false);
INSERT INTO reserves VALUES (3, 1, "complex_3", "2018-03-23 19:00:00", 1, 5, "2018-03-20 12:00:04", false);
INSERT INTO reserves VALUES (2, 2, "complex_2", "2018-03-23 19:00:00", 2, 6, "2018-03-20 12:00:33", false);

INSERT INTO reserves VALUES (4, 4, "complex_1", "2018-03-23 19:00:00", 4, 1, "2018-03-20 12:00:00", false);
INSERT INTO reserves VALUES (2, 5, "complex_1", "2018-03-23 19:00:00", 5, 1, "2018-03-20 13:00:00", true);
INSERT INTO reserves VALUES (3, 2, "complex_2", "2018-03-23 19:00:00", 2, 1, "2018-03-20 14:00:00", false);
INSERT INTO reserves VALUES (2, 4, "complex_1", "2018-03-23 19:00:00", 4, 1, "2018-03-20 15:00:00", false);

INSERT INTO reserves VALUES (5, 3, "complex_3", "2018-03-23 19:00:00", 3, 2, "2018-03-20 15:00:00", false);
INSERT INTO reserves VALUES (6, 1, "complex_3", "2018-03-23 19:00:00", 1, 2, "2018-03-20 13:00:00", false);
INSERT INTO reserves VALUES (4, 2, "complex_2", "2018-03-23 19:00:00", 2, 2, "2018-03-20 9:00:00", false);
INSERT INTO reserves VALUES (2, 6, "complex_1", "2018-03-23 19:00:00", 6, 2, "2018-03-20 2:00:00", false);

