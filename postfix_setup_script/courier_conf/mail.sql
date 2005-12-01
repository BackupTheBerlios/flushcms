CREATE DATABASE mail;

GRANT ALL ON mail.* TO mail@localhost

IDENTIFIED BY "secret";

FLUSH PRIVILEGES;

 

USE mail;

CREATE TABLE USER (
ID int(10) unsigned NOT NULL auto_increment,
USERNAME varchar(128) NOT NULL default '',
PASSWORD varchar(40) NOT NULL default '',
CLEAR_PASSWORD varchar(40) NOT NULL default '', 
FORWARD varchar(128) NOT NULL default '',
DOMAIN varchar(64) NOT NULL default '',
HOMEDIR varchar(128) NOT NULL default '',
MAILDIR varchar(128) NOT NULL default '', 
MAIL varchar(64) NOT NULL default '', 
GID int(11) NOT NULL default 450,
UID int(11) NOT NULL default 450,
FILTER varchar(64) NOT NULL default 'OK',
QUOTA int(11) NOT NULL default '10485760',
STATUS tinyint(4) NOT NULL default '1',
PRIMARY KEY (ID),
UNIQUE KEY USERNAME (USERNAME),
UNIQUE KEY MAIL (MAIL)
) TYPE=MyISAM;

 

INSERT INTO USER (USERNAME,PASSWORD,CLEAR_PASSWORD,
FORWARD,DOMAIN,HOMEDIR,MAILDIR,MAIL)

VALUES ('trueuser','$1$pi.WVgBx$a3dUCzBnbY76jnZlqWQCQ/','testpw',

'trueuser','cngnu.org','/data/mail/trueuser','/data/mail/trueuser/Maildir',

'trueuser@cngnu.org'),
('virtualuser@cngnu.org','$1$pi.WVgBx$a3dUCzBnbY76jnZlqWQCQ/','testpw',

'virtualuser@cngnu.org','cngnu.org','/data/mail/cngnu.org/virtualuser',
'/data/mail/cngnu.org/virtualuser/Maildir','virtualuser@cngnu.org');

