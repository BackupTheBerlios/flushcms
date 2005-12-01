CREATE DATABASE pdns;
GRANT ALL ON pdns.* TO pdns@localhost
IDENTIFIED BY "pdns";
FLUSH PRIVILEGES;

USE pdns;

create table domains (
 id		 INT auto_increment,
 name		 VARCHAR(255) NOT NULL,
 master		 VARCHAR(20) DEFAULT NULL,
 last_check	 INT DEFAULT NULL,
 type		 VARCHAR(6) NOT NULL,
 notified_serial INT DEFAULT NULL, 
 account         VARCHAR(40) DEFAULT NULL,
 primary key (id)
)type=InnoDB;

CREATE UNIQUE INDEX name_index ON domains(name);

CREATE TABLE records (
  id              INT auto_increment,
  domain_id       INT DEFAULT NULL,
  name            VARCHAR(255) DEFAULT NULL,
  type            VARCHAR(6) DEFAULT NULL,
  content         VARCHAR(255) DEFAULT NULL,
  ttl             INT DEFAULT NULL,
  prio            INT DEFAULT NULL,
  change_date     INT DEFAULT NULL,
  primary key(id)
)type=InnoDB;

CREATE INDEX rec_name_index ON records(name);
CREATE INDEX nametype_index ON records(name,type);
CREATE INDEX domain_id ON records(domain_id);

create table supermasters (
  ip VARCHAR(25) NOT NULL, 
  nameserver VARCHAR(255) NOT NULL, 
  account VARCHAR(40) DEFAULT NULL
);

GRANT SELECT ON supermasters TO pdns;
GRANT ALL ON domains TO pdns;
GRANT ALL ON records TO pdns;

INSERT INTO domains (name, type) values ('test.com', 'NATIVE');
INSERT INTO records (domain_id, name, content, type,ttl,prio) 
	VALUES (1,'test.com','localhost ahu@ds9a.nl 1','SOA',86400,NULL);
INSERT INTO records (domain_id, name, content, type,ttl,prio)
	VALUES (1,'test.com','dns-us1.powerdns.net','NS',86400,NULL);
INSERT INTO records (domain_id, name, content, type,ttl,prio)
	VALUES (1,'test.com','dns-eu1.powerdns.net','NS',86400,NULL);
INSERT INTO records (domain_id, name, content, type,ttl,prio)
	VALUES (1,'www.test.com','199.198.197.196','A',120,NULL);
INSERT INTO records (domain_id, name, content, type,ttl,prio)
	VALUES (1,'mail.test.com','195.194.193.192','A',120,NULL);
INSERT INTO records (domain_id, name, content, type,ttl,prio)
	VALUES (1,'localhost.test.com','127.0.0.1','A',120,NULL);
INSERT INTO records (domain_id, name, content, type,ttl,prio)
	VALUES (1,'test.com','mail.test.com','MX',120,25);
