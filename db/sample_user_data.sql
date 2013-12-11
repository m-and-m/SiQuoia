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
("user1", "30", "60", "0"),
("user2", "30", "13", "0"),
("user3", "30", "32", "0"),
("user4", "30", "43", "0"),
("user5", "30", "8", "0"),
("user6", "30", "75", "0"),
("user7", "30", "100", "0"),
("user8", "30", "53", "0");
