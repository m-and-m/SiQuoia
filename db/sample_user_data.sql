INSERT INTO user_profile (userid, username, useremail, isadmin, userpass, introducedby) VALUES 
("user0", "admin", "admin", "1", "a",null),
("user1","scatcat","scatcat@gmail.com","0","a",null),
("user2","berlioz","berlioz@gmail.com","0","a","user1"),
("user3","toulouse","toulouse@gmail.com","0","a","user1"),
("user4","duchess","duchess@gmail.com","1","a",null),
("user5","thomas o\'malley","thomas@gmail.com","1","a",null),
("user6","marie","marie@gmail.com","0","a",null),
("user7","Winnie The Pooh","pooh@gmail.com","0","a","user6"),
("user8","eeyore","eeyore@gmail.com","0","a","user6");

INSERT INTO user_data (userid, usercredit, userpoint, usedtrial) VALUES 
("user0", "30", "8", "0"),
("user1", "55", "60", "0"),
("user2", "30", "13", "0"),
("user3", "75", "32", "0"),
("user4", "80", "43", "0"),
("user5", "30", "8", "0"),
("user6", "100", "75", "0"),
("user7", "100", "100", "0"),
("user8", "0", "53", "0");
