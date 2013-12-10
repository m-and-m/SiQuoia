INSERT INTO subject VALUES ("s0","TV");
INSERT INTO subject VALUES ("s1","sports");
INSERT INTO subject VALUES ("s10","cars");
INSERT INTO subject VALUES ("s9","branded");

INSERT INTO topic VALUES ("t0","comedy","s0");
INSERT INTO topic VALUES ("t1","football","s1");
INSERT INTO topic VALUES ("t2","basketball","s1");
INSERT INTO topic VALUES ("t9","branded","s9");
INSERT INTO topic (topicid, t_name, subjectid) VALUES ('t20', 'auto racing', 's1');


INSERT INTO subtopic VALUES ("st0","friends","t0");
INSERT INTO subtopic VALUES ("st1","nfl football","t1");
INSERT INTO subtopic VALUES ("st2","ncaa football","t1");
INSERT INTO subtopic VALUES ("st3","nba basketball","t2");
INSERT INTO subtopic VALUES ("st4","ncaa basketball","t2");
INSERT INTO subtopic VALUES ("st6","misc","t4");
INSERT INTO subtopic (subtopicid, st_name, topicid) VALUES ('st9', 'lexus', 't9');

INSERT INTO subtopic (subtopicid, st_name, topicid) VALUES
('st20', 'racing courses', 't20'),
('st21', 'domestic cars', 't20'),
('st22', 'drifting', 't20'),
('st23', 'import cars', 't20'),
('st24', 'racing modifications', 't20'),
('st25', 'racing general', 't20');