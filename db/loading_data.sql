INSERT INTO question VALUES (
'q0','What is Monica\'s biggest pet peeve?','',
'Animals dressed as humans.',
'Humans dressed like animals.',
'Not using a coaster.',
'Not being the best.',
1,'st0',0,0,'','');
INSERT INTO question VALUES (
'q1','According to Chandler\, what phenomenon scares the bejesus out of him?','',
'Talking dogs.',
'Michael Flatley, Lord of the Dance.',
'Thanksgiving.',
'Christmas',
2,'st0',0,0,'','');
INSERT INTO question VALUES (
'q2','Every week the TV Guide comes to Chandler and Joey\'s apartment. What name appears on the address label?','',
'Ms. Chanandler Bong',
'Chandler Bing',
'Joey Tribianni',
'Ms. Joie Tribanini',
1,'st0',0,0,'','');
INSERT INTO question VALUES (
'q3','What are the names of Rachel\'s sisters?','',
'Emma and Erica',
'Phoebe and Monica',
'Jill and Amy',
'Carol and Susan',
3,'st0',0,0,'','');
INSERT INTO question VALUES (
'q4','Monica and Ross had a grandmother who died. What was that grandmother\'s name?','',
'Agnes',
'Judy',
'Amy',
'Althea',
4,'st0',0,0,'','');
INSERT INTO question VALUES (
'q5','What is the name of Chandler\'s father\'s Las Vegas all-male burlesque?','',
'Viva Las Vegas.',
'It''s Raining Men.',
'Magic Eight Balls.',
'Viva Las Gaygas.',
4,'st0',0,0,'','');
INSERT INTO question VALUES (
'q6','What was Monica\'s nickname when she was a field hockey goalie?','',
'Big Thunder',
'Fat Guard',
'Big Fat Goalie',
'Harmonica',
3,'st0',0,0,'','');
INSERT INTO question VALUES (
'q7','Rachel Claims this is her favorite movie?','',
'Dangerous Liasons',
'Pretty in Pink',
'Weekend at Bernie''s',
'Breakfast at Tiffany''s',
1,'st0',0,0,'','');
INSERT INTO question VALUES (
'q8','Rachel''s ACTUAL favorite movie is?','',
'Dangerous Liasons',
'Pretty in Pink',
'Weekend at Bernie''s',
'Breakfast at Tiffany''s',
3,'st0',0,0,'','');
INSERT INTO question VALUES (
'q9','In what part of her body did Monica get a pencil stuck at age 14?','',
'Her bajingo.',
'Her nose.',
'Her ear.',
'Her hand.',
3,'st0',0,0,'','');
INSERT INTO question VALUES (
'q10','How many children does Ross have?','',
'One',
'Two',
'Three',
'Zero',
2,'st0',0,0,'','');
INSERT INTO question VALUES (
'q11','What is Joey\'s favorite food?','',
'Spaghetti.',
'Sandwiches.',
'Steak.',
'All of the above.',
2,'st0',0,0,'','');
INSERT INTO question VALUES (
'q12','Chandler was how old when he first touched a girl\'s breast?','',
'Seventeen.',
'Eighteen.',
'Nineteen.',
'Twenty.',
3,'st0',0,0,'','');
INSERT INTO question VALUES (
'q13','Joey had an imaginary childhood friend. What was his name and profession?','',
'Maurice, Space Cowboy.',
'Dr. Drake Ramoray, Neurosurgeon.',
'Dr. Hans Ramoray, Evil Twin.',
'Hugsy, Penguin Pal.',
1,'st0',0,0,'','');
INSERT INTO question VALUES (
'q14','Before the coffee shop became Central Perk, what did the establishment did it use to be?','',
'Book Store',
'Bar',
'Restaurant',
'Video Store',
2,'st0',0,0,'','');
INSERT INTO question VALUES (
'q15','How many girls has Ross married?','',
'One',
'Two',
'Three',
'Four',
3,'st0',0,0,'','');
INSERT INTO question VALUES (
'q16','Who is Princess Consuela Bananahammock','',
'Phoebe Buffay',
'Regina Phalange',
'Emily Waltham',
'Melissa Warburton',
1,'st0',0,0,'','');
INSERT INTO question VALUES (
'q17','Monica Categorizes her towels. How many categories are there?','',
'Eleven.',
'Ten.',
'Three.',
'Two.',
1,'st0',0,0,'','');
INSERT INTO question VALUES (
'q18','What is the name of Ross''s monkey?','',
'Hugsy',
'Marcel',
'Emma',
'Ben',
2,'st0',0,0,'','');
INSERT INTO question VALUES (
'q19','Joey has an animal whose name is Pat. What type of animal is it?','',
'the dog',
'the cat',
'the monkey',
'the penguin',
1,'st0',0,0,'','');
UPDATE question SET evaluatedby = 'admin';

INSERT INTO packet VALUES (
"p1","trial","",
"[\"q0\", \"q1\", \"q2\", \"q3\", \"q4\", \"q5\", \"q6\", \"q7\", \"q8\", \"q9\",\"q10\", \"q11\", \"q12\", \"q13\", \"q14\",\"q15\", \"q16\", \"q17\", \"q18\", \"q19\"]");

INSERT INTO packet VALUES (
"p2","nfl football","",
"[\"q2001\", \"q2002\", \"q2003\", \"q2004\", \"q2005\", \"q2006\", \"q2007\", \"q2008\", \"q2009\", \"q2010\", \"q2011\", \"q2012\", \"q2013\", \"q2014\", \"q2015\",\"q2016\", \"q2017\", \"q2018\", \"q2019\", \"q2020\"]");

INSERT INTO packet VALUES (
"p3","ncaa football","",
"[\"q2021\", \"q2022\", \"q2023\", \"q2024\", \"q2025\", \"q2026\", \"q2027\", \"q2028\", \"q2029\", \"q2030\", \"q2031\", \"q2032\", \"q2033\", \"q2034\", \"q2035\",\"q2036\", \"q2037\", \"q2038\", \"q2039\", \"q2040\"]");

INSERT INTO packet VALUES (
"p4","nba basketball","",
"[\"q2041\", \"q2042\", \"q2043\", \"q2044\", \"q2045\", \"q2046\", \"q2047\", \"q2048\", \"q2049\", \"q2050\", \"q2051\", \"q2052\", \"q2053\", \"q2054\", \"q2055\",\"q2056\", \"q2057\", \"q2058\", \"q2059\", \"q2060\"]");

INSERT INTO packet VALUES (
"p5","ncaa basketball","",
"[\"q2061\", \"q2062\", \"q2063\", \"q2064\", \"q2065\", \"q2066\", \"q2067\", \"q2068\", \"q2069\", \"q2070\", \"q2071\", \"q2072\", \"q2073\", \"q2074\", \"q2075\",\"q2076\", \"q2077\", \"q2078\", \"q2079\", \"q2080\"]");

INSERT INTO packet VALUES (
"p10","lexus cars","LEXUS",
"[\"q0501\", \"q0502\", \"q0503\", \"q0504\", \"q0505\", \"q0506\", \"q0507\", \"q0508\", \"q0509\", \"q0510\", \"q0511\", \"q0512\", \"q0513\", \"q0514\", \"q0515\",\"q0516\", \"q0517\", \"q0518\", \"q0519\", \"q0520\"]");

INSERT INTO packet VALUES (
"p20","auto racing","",
"[\"q6016\", \"q6020\", \"q6021\", \"q6029\", \"q6001\", \"q6002\", \"q6003\", \"q6004\", \"q6015\", \"q6017\", \"q6018\", \"q6019\", \"q6026\", \"q6005\", \"q6006\", \"q6027\", \"q6028\"]");

INSERT INTO packet VALUES (
"p21","auto general","",
"[\"q6007\", \"q6010\", \"q6011\", \"q6012\", \"q6013\", \"q6014\", \"q6022\", \"q6023\", \"q6008\", \"q6009\", \"q6024\", \"q6025\"]");

-- INSERT INTO packet VALUES ( "p1","trial","", "[\"q20\", \"q21\", \"q22\", \"q3\", \"q4\"]");

INSERT INTO subject VALUES ("s0","TV");
INSERT INTO subject VALUES ("s1","sports");
INSERT INTO subject VALUES ("s2","science");
INSERT INTO subject VALUES ("s3","movie");
INSERT INTO topic VALUES ("t0","comedy","s0");
INSERT INTO topic VALUES ("t1","football","s1");
INSERT INTO topic VALUES ("t2","basketball","s1");
-- INSERT INTO topic VALUES ("t3","math","s2");
-- INSERT INTO topic VALUES ("t4","disney","s3");
INSERT INTO subtopic VALUES ("st0","friends","t0");
INSERT INTO subtopic VALUES ("st1","nfl football","t1");
INSERT INTO subtopic VALUES ("st2","ncaa football","t1");
INSERT INTO subtopic VALUES ("st3","nba basketball","t2");
INSERT INTO subtopic VALUES ("st4","ncaa basketball","t2");
-- INSERT INTO subtopic VALUES ("st5","algebra","t3");
INSERT INTO subtopic VALUES ("st6","misc","t4");

-- Cars -> Japanese -> Lexus
INSERT INTO subject VALUES ("s10","cars");
INSERT INTO topic (topicid, t_name, subjectid) VALUES ('t10', 'japanese', 's10');
INSERT INTO subtopic (subtopicid, st_name, topicid) VALUES ('st10', 'lexus', 't10');

-- Sports -> Auto Racing -> ?? (from autos.php / autos.sql)
INSERT INTO topic (topicid, t_name, subjectid) VALUES ('t20', 'auto racing', 's1');
INSERT INTO subtopic (subtopicid, st_name, topicid) VALUES
('st20', 'courses', 't20'),
('st21', 'domestic', 't20'),
('st22', 'drifting', 't20'),
('st23', 'import', 't20'),
('st24', 'modifications', 't20'),
('st25', 'racing', 't20');

INSERT INTO user_profile (userid, username, useremail, isadmin, userpass) VALUES ("user0", "admin", "admin", "1", "aaa");

INSERT INTO user_data (userid, userpoint, usercredit, usedtrial) VALUES ("user0", "15", "0", "0");