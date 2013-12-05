DROP TABLE IF EXISTS user_data;
DROP TABLE IF EXISTS user_profile;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS subtopic;
DROP TABLE IF EXISTS topic;
DROP TABLE IF EXISTS subject;
DROP TABLE IF EXISTS packet;
DROP TABLE IF EXISTS purchase;

/*NOTE (user_profile):*/
/*userid: user999999 (up to 10M)*/
/*userpass: bcrypted*/
/*introducedby: userid of the introducing user*/
CREATE TABLE user_profile (
	userid VARCHAR(10) NOT NULL,
	username VARCHAR(30) NOT NULL,
	useremail VARCHAR(100) NOT NULL,
	isadmin  TINYINT(1) NOT NULL,  
	userpass TEXT NOT NULL,
	introducedby VARCHAR(10),
	twitter TEXT, 
	facebook TEXT,
	PRIMARY KEY(userid)
);

/* NOTE (user_data):*/ 
/*savedquiz: store JSON data including question set and the pointer to indicate the last question*/
/*Delete a row from user_profile, then automatically delete a correspond row from user_data */
CREATE TABLE user_data (
	userid VARCHAR(10) NOT NULL,
	userpoint INT,
	usercredit INT, 
	savedquiz TEXT,
	usedtrial TINYINT(1) NOT NULL,
	FOREIGN KEY(userid) REFERENCES user_profile(userid) ON DELETE CASCADE
);

/* NOTE (question):*/ 
/*qid: q999999 (up to 10M)*/ 
/*correct_count & use_count are used for q.ranking*/
/*	FOREIGN KEY(subtopicid) REFERENCES subtopic(subtopicid) ON DELETE CASCADE*/
CREATE TABLE question (
	qid VARCHAR(7) NOT NULL,
	question TEXT NOT NULL,
	answer1 TEXT NOT NULL,
	answer2 TEXT NOT NULL,
	answer3 TEXT NOT NULL,
	answer4 TEXT NOT NULL,
	correct_answer INT NOT NULL,
	subtopicid VARCHAR(7),
	correct_count INT,
	use_count INT,
	PRIMARY KEY(qid)
);

/*FOREIGN KEY(topicid) REFERENCES topic(topicid) ON DELETE CASCADE*/
CREATE TABLE subtopic (
	subtopicid VARCHAR(7) NOT NULL,
	st_name VARCHAR(30) NOT NULL,
	topicid VARCHAR(7) NOT NULL,
	PRIMARY KEY(subtopicid)
);

/*FOREIGN KEY(subjectid) REFERENCES subject(subjectid) ON DELETE CASCADE*/
CREATE TABLE topic (
	topicid VARCHAR(7) NOT NULL,
	t_name VARCHAR(30) NOT NULL,
	subjectid VARCHAR(7) NOT NULL,
	PRIMARY KEY(topicid)
);

CREATE TABLE subject (
	subjectid VARCHAR(7) NOT NULL,
	s_name VARCHAR(30) NOT NULL,
	PRIMARY KEY(subjectid)
);

CREATE TABLE packet (
	packetid VARCHAR(7) NOT NULL,
	p_name VARCHAR(30) NOT NULL,
	cost INT,
	questionid_set TEXT,
	PRIMARY KEY(packetid)
);

CREATE TABLE purchase (
	userid VARCHAR(7) NOT NULL,
	packetid VARCHAR(7) NOT NULL,
	cost INT,
	PRIMARY KEY(userid, packetid)
);