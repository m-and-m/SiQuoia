INSERT INTO user_profile (userid, username, useremail, isadmin, userpass, introducedby) VALUES 
("user0", "admin", "admin", "1", "a",null),
("user1","scatcat","scatcat@gmail.com","0","a",null),
("user2","berlioz","berlioz@gmail.com","0","a","user1"),
("user3","toulouse","toulouse@gmail.com","0","a","user1"),
("user4","duchess","duchess@gmail.com","1","a",null),
("user5","thomas o\'malley","thomas@gmail.com","1","a",null),
("user6","marie","marie@gmail.com","0","a",null),
("user7","WTP","pooh@gmail.com","0","a","user6");

INSERT INTO user_data (userid, usercredit, userpoint, usedtrial) VALUES 
("user0", "15", "0", "0"),
("user1", "15", "0", "0"),
("user2", "15", "0", "0"),
("user3", "15", "0", "0"),
("user4", "15", "0", "0"),
("user5", "15", "0", "0"),
("user6", "15", "0", "0"),
("user7", "15", "0", "0");

