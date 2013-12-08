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

INSERT INTO packet VALUES (
"p1","trial","",
"[\"q0\", \"q1\", \"q2\", \"q3\", \"q4\", \"q5\", \"q6\", \"q7\", \"q8\", \"q9\",\"q10\", \"q11\", \"q12\", \"q13\", \"q14\",\"q15\", \"q16\", \"q17\", \"q18\", \"q19\"]");
/* 
"[{\"id\":\"q0\",\"answered\":\"0\"},{\"id\":\"q1\",\"answered\":\"0\"},{\"id\":\"q2\",\"answered\":\"0\"},{\"id\":\"q3\",\"answered\":\"0\"},{\"id\":\"q4\",\"answered\":\"0\"},{\"id\":\"q5\",\"answered\":\"0\"},{\"id\":\"q6\",\"answered\":\"0\"},{\"id\":\"q7\",\"answered\":\"0\"},{\"id\":\"q8\",\"answered\":\"0\"},{\"id\":\"q9\",\"answered\":\"0\"},{\"id\":\"q10\",\"answered\":\"0\"},{\"id\":\"q11\",\"answered\":\"0\"},{\"id\":\"q12\",\"answered\":\"0\"},{\"id\":\"q13\",\"answered\":\"0\"},{\"id\":\"q14\",\"answered\":\"0\"},{\"id\":\"q15\",\"answered\":\"0\"},{\"id\":\"q16\",\"answered\":\"0\"},{\"id\":\"q17\",\"answered\":\"0\"},{\"id\":\"q18\",\"answered\":\"0\"},{\"id\":\"q19\",\"answered\":\"0\"}]"
"[\"q0\", \"q1\", \"q2\", \"q3\", \"q4\", \"q5\", \"q6\", \"q7\", \"q8\", \"q9\",\"q10\", \"q11\", \"q12\", \"q13\", \"q14\",\"q15\", \"q16\", \"q17\", \"q18\", \"q19\"]"
*/

INSERT INTO subject VALUES ("s0","trial");
INSERT INTO subject VALUES ("s1","sports");
INSERT INTO subject VALUES ("s2","science");
INSERT INTO topic VALUES ("t0","trial","s0");
INSERT INTO topic VALUES ("t1","football","s1");
INSERT INTO topic VALUES ("t2","basketball","s1");
INSERT INTO topic VALUES ("t3","math","s2");
INSERT INTO subtopic VALUES ("st0","trial","t0");
INSERT INTO subtopic VALUES ("st1","nfl football","t1");
INSERT INTO subtopic VALUES ("st2","ncaa football","t1");
INSERT INTO subtopic VALUES ("st3","nba basketball","t2");
INSERT INTO subtopic VALUES ("st4","ncaa basketball","t2");
INSERT INTO subtopic VALUES ("st5","algebra","t3");